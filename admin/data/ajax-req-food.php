<?php
/**
 * Created by PhpStorm.
 * User: Oyon
 * Date: 2/13/2016
 * Time: 2:03 PM
 */

//require database function
require '../../model/db.php';

//declare an array which will be returnd as JSON
$resp = array();

if(isset($_POST['add_addi_food_name'])){    // add additional food
    $name = $_POST['add_addi_food_name'];
    $cost = $_POST['add_addi_food_price'];
    $keys = $_POST['add_addi_food_keys'];

    $target_dir = '../../assets/img/food/';
    $fn = $_FILES["add_addi_food_image"]["name"];

    $target_file = $target_dir . basename($fn);
    $imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);

    if(!empty($fn)) {
        $file = $_FILES['add_addi_food_image'];
        $check = getimagesize($_FILES["add_addi_food_image"]["tmp_name"]);
        if ($check !== false) {
            $file_path = $target_dir . $file['name'];
            move_uploaded_file($file['tmp_name'], $file_path);

            $image = $file['name'];
        }
    }else{
        $image = "Demo.png";
    }
    insertNewFood($name, $cost, $image, $keys);

    if(isset($_POST['special'])){
        $row = addiFoodFull();
    }else{
        $row = addiFood();
    }

    $resp = $row;
    echo json_encode($resp);
}elseif(isset($_POST['addiFoodKey'])){   // delete aditional food
    $id = $_POST['addiFoodKey'];
    deleteAddiFood($id);
    if(isset($_POST['special'])){
        $row = addiFoodFull();
    }else{
        $row = addiFood();
    }
    $resp = $row;
    echo json_encode($resp);
}elseif(isset($_POST['addiFoodID'])){     //Get all additional food data
    $id = $_POST['addiFoodID'];
    $row = getAddiFoodInfo($id);
    $resp = $row;
    echo json_encode($resp);
}elseif(isset($_POST['edit_addi_food_name'])){     //modify additional food information
    $name = $_POST['edit_addi_food_name'];
    $cost = $_POST['edit_addi_food_price'];
    $keys = $_POST['edit_addi_food_keywords'];
    $id = $_POST['edit_addi_food_key'];

    $target_dir = '../../assets/img/food/';
    $fn = $_FILES["edit_addi_food_image"]["name"];

    $target_file = $target_dir . basename($fn);
    $imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);

    if(!empty($fn)) {
        $file = $_FILES['edit_addi_food_image'];
        $check = getimagesize($_FILES["edit_addi_food_image"]["tmp_name"]);
        if ($check !== false) {
            $file_path = $target_dir . $file['name'];
            move_uploaded_file($file['tmp_name'], $file_path);

            $image = $file['name'];

            //call function to modify Additional Food
            updateAdditionalFood($name, $cost, $keys, $image, $id);
        }
    }else{
        updateAdditionalFoodWithoutImage($name, $cost, $keys, $id);
    }

    //return updated data
    if(isset($_POST['special'])){
        $row = addiFoodFull();
    }else{
        $row = addiFood();
    }
    $resp = $row;
    echo json_encode($resp);
}elseif(isset($_POST['newSetMenuTitle'])){   // add set menu
    $title = $_POST['newSetMenuTitle'];
    $items = $_POST['newSetMenuItems'];
    $cost = $_POST['newSetMenuCost'];

    insertNewSetItems($title, $items, $cost);
    $row = setMenu();
    $resp = $row;
    echo json_encode($resp);
}elseif(isset($_POST['setMenuKey'])){   //delete set menu
    $key = $_POST['setMenuKey'];

    deleteSetMenu($key);
    $row = setMenu();
    $resp = $row;
    echo json_encode($resp);
}elseif(isset($_POST['setItemsID'])){  //get all set menu info
    $key = $_POST['setItemsID'];
    $row = setMenuInfo($key);
    $resp['key'] = $row['sm_id'];
    $resp['Name'] = $row['sm_title'];
    $resp['items'] = $row['sm_description'];
    $resp['value'] = $row['sm_price'];
    echo json_encode($resp);
}elseif(isset($_POST['setMenuEditedName'])){  //update setmenu info
    $title = $_POST['setMenuEditedName'];
    $cost = $_POST['setMenuEditedCost'];
    $key = $_POST['setMenuEditedKey'];
    $items = $_POST['setMenuItems'];

    updateSetMenu($title, $items, $cost, $key);
    $row = setMenu();
    $resp = $row;
    echo json_encode($resp);
}
?>