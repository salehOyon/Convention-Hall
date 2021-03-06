<?php
/**
 * @author Saleh Ahmad <oyon@nooblonely.com>
 * @copyright 2015-2016 Noob Lonely
 */

/** Define Constants */

/** Define Protocol */
define('PROTOCOL', ((!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] != 'off') ||
    $_SERVER['SERVER_PORT'] == 443) ? "https://" : "http://");

/** Define Server Name */
define('SERVER', PROTOCOL.$_SERVER['SERVER_NAME'].'/convention');
define('DEFAULT__IMAGE', ''.SERVER.'/assets/img');
