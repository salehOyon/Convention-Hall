<?php
    require 'controller/define.php';
    $login = false;
    if (isset($_COOKIE['user']) || isset($_SESSION['user'])) {
        if (!isset($_SESSION['user'])) {
            $_SESSION['user'] = $_COOKIE['user'];
        }
        $login = true;
    }
    if ($login) {
        header('Location: '.SERVER.'');
    }
?>
<!DOCTYPE HTML>
<html>
    <head>
        <?php require_once 'includes/head.php'; ?>
        <link href="<?= SERVER; ?>/assets/css/bootstrap-3.3.5-dist/css/bootstrap.min.css" rel="stylesheet"/>
        <link href="<?= SERVER; ?>/assets/css/custom.css" rel="stylesheet"/>
        <link href="<?= SERVER; ?>/assets/css/checkbox.css" rel="stylesheet"/>
        <style>body { padding-top: 70px; }</style>
    </head>
    <body>
        <div id="wrap">
            <main>
                <header>
                    <?php require 'includes/nav.php'; ?>
                </header>
                <section>
                    <div class="cover-image-sign-up"></div>
                    <div class="container">
                <div class="row">
                    <div class="col-sm-12">
                        <div class="col-sm-8 col-lg-6 col-centered">
                            <div class="padding-20">
                                <div class="padding-border solid-border">
                                    <h1>Sign Up</h1>
                                    <br/><br/>
                                    <form action="<?php echo SERVER; ?>/controller/signUpSuccess"
                                          method="post"
                                          onsubmit="return confirmation();">
                                <div class="form-group">
                                    <label>First Name</label>
                                    <input type="text"
                                           class="onlyChars form-control"
                                           autofocus="autofocus"
                                           name="fname"
                                           pattern="(?=.*[a-zA-Z])+([.,\s])*.{2,}"
                                           title="Only letters, space, dot and comma allowed" />
                                </div>
                                <div class="form-group">
                                    <label>Last Name</label>
                                    <input type="text"
                                           class="onlyChars form-control"
                                           name="lname"
                                           pattern="(?=.*[a-zA-Z])+([.,\s])*.{2,}"
                                           title="Only letters, space, dot and comma allowed" />
                                </div>
                                <div class="form-group" id="emailVal">
                                    <p id="email" class="text-danger"></p>
                                    <label>Email</label>
                                    <input type="email"
                                           class="form-control has-success has-feedback"
                                           id='email1'
                                           name="email"
                                           required="required"
                                           pattern="[([\w-]+(?:\.[\w-]+)*)@((?:[\w-]+\.)*\w[\w-]{0,66})\.([a-z]{2,6}(?:\.[a-z]{2})?)]i"
                                           onchange="this.setCustomValidity(this.validity.patternMismatch ? 'Insert Email Correctly' : ''); if(this.checkValidity()) form.cemail.pattern = this.value;"
                                           onblur="validateEmail('email', this.value)" />
                                </div>
                                <div class="form-group">
                                    <label>Confirm Email</label>
                                    <input type="email"
                                           class="form-control"
                                           name="cemail"
                                           required="required"
                                           pattern="[([\w-]+(?:\.[\w-]+)*)@((?:[\w-]+\.)*\w[\w-]{0,66})\.([a-z]{2,6}(?:\.[a-z]{2})?)]i"
                                           onchange="this.setCustomValidity(this.validity.patternMismatch ? 'Please enter the same email as above' : '');" />
                                </div>
                                <div class="form-group">
                                    <label>Contact No.</label>
                                    <input type="tel"
                                           class="phnNum form-control"
                                           name="contact"
                                           id="phone"
                                           required="required"
                                           pattern="(?=.*[0-9])+.{5,}"
                                           title="please insert a valid Phone Number" />
                                </div>
                                <div class="form-group">
                                    <label>Password</label>
                                    <input type="password"
                                           class="form-control"
                                           name="pass"
                                           required="required"
                                           id="newPass"
                                           pattern="(?=^.{4,}$)(?=.*\d)(?=.*[!@#$%^&*]+)(?![.\n])(?=.*[A-Z])(?=.*[a-z]).*$"
                                           onchange="this.setCustomValidity(this.validity.patternMismatch ? 'The password must contain one or more uppercase characters, one or more lowercase characters, one or more numeric values, one or more special characters, and length must be greater than or equal to 4' : ''); if(this.checkValidity()) form.cpass.pattern = this.value;" />
                                </div>
                                <div class="form-group">
                                    <label>Confirm Password</label>
                                    <input type="password"
                                           class="form-control"
                                           name="cpass"
                                           required="required"
                                           id="confirmNewPass"
                                           pattern="(?=^.{4,}$)(?=.*\d)(?=.*[!@#$%^&*]+)(?![.\n])(?=.*[A-Z])(?=.*[a-z]).*$"
                                           onchange="this.setCustomValidity(this.validity.patternMismatch ? 'Please enter the same Password as above' : '');" />
                                </div>
                                <div class="form-group">
                                    <div class="cf">
                                        <label for="agree" class="ccbx" style="font-weight: normal">
                                            <input type="checkbox"
                                                   required="required"
                                                   id="agree"
                                                   name="agree">&nbsp;&nbsp;<b>I agree all terms and conditions.</b>
                                        </label>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div id="html_element"></div>
                                </div>
                                <button type="submit" name="signUpBtn" class="btn btn-primary btn-block">Sign Up</button><br/>
                            </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
                </section>
                <br/><br/><br/>
            </main>
        </div>
        <footer>
            <?php require "includes/footer.php";?>
        </footer>

        <script src="<?= SERVER; ?>/assets/js/jquery-2.2.0.min.js"></script>
        <script src="<?= SERVER; ?>/assets/js/checkbox.js"></script>
        <script src="<?= SERVER; ?>/assets/js/jquery.maskedinput.min.js"></script>
        <script src="<?= SERVER; ?>/assets/js/custom.js"></script>
        <script src="<?= SERVER; ?>/assets/css/bootstrap-3.3.5-dist/js/bootstrap.js"></script>

        <script type="text/javascript">
            var size = $(window).width() <= 480 ? 'compact' : 'normal';
            var onloadCallback = function() {
                grecaptcha.render('html_element', {
                    'sitekey' : '6Ld3rg8TAAAAACGH7e9bMjc8f8ZIPFRBoRwh9r0v',
                    'theme'   : 'dark',
                    'size'    : size
                });
            };
        </script>
        <script src="https://www.google.com/recaptcha/api.js?onload=onloadCallback&render=explicit"
                async defer>
        </script>
        <script src="<?= SERVER; ?>/assets/js/validate_script.js"></script>
    </body>
</html>