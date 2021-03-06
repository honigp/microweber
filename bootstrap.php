<?php

defined('T') OR die();


//date_default_timezone_set("America/Chicago");

/*
 * Set everything to UTF-8
 */
//setlocale(LC_ALL, 'en_US.utf-8');
//iconv_set_encoding("internal_encoding", "UTF-8");
//mb_internal_encoding('UTF-8');


$mw_config = array();

$mw_config['site_url'] = site_url();
//use slash at the end

$mw_config['system_folder'] = 'application';
$mw_config['application_folder'] = 'application';
if (!ini_get('safe_mode')) {
    if (function_exists('session_set_cookie_params')) {
        session_set_cookie_params(86400);
//Sets the session cookie lifetime to 12 hours.
    }
}


if (!defined('E_STRICT')) {

    define(E_STRICT, 0);
}

//
//error_reporting ( E_ALL & ~ E_STRICT );
 //error_reporting(E_ALL);
$system_folder = $mw_config['system_folder'];

$application_folder = $mw_config['application_folder'];

if (isset($mw_config['system_folder_shared'])) {
    if ($mw_config['system_folder_shared'] == false) {

        if (strpos($system_folder, '/') === FALSE) {
            if (function_exists('realpath') and @realpath(dirname(__FILE__)) !== FALSE) {
                $system_folder = realpath(dirname(__FILE__)) . '/' . $system_folder;
            }
        } else {
            // Swap directory separators to Unix style for consistency
            $system_folder = str_replace("\\", "/", $system_folder);
        }
    } else {
        $system_folder = $mw_config['system_folder_shared'];
    }
}
/*

 |---------------------------------------------------------------
 | DEFINE APPLICATION CONSTANTS

 |---------------------------------------------------------------

 */

//define('EXT', '.' . pathinfo(__FILE__, PATHINFO_EXTENSION));

define("DS", DIRECTORY_SEPARATOR);
//define('FCPATH', __FILE__);

define('MW_ROOTPATH', dirname(__FILE__) . DS);

define('MW_SELF', pathinfo(__FILE__, PATHINFO_BASENAME));

define('MW_BASEPATH', $system_folder . DS);

define('MW_BASEPATHSTATIC', MW_ROOTPATH . 'static/');

#define ( 'MW_BASEPATHCONTENT', MW_BASEPATH . 'content/' );

define('MW_USERFILES_DIRNAME', 'userfiles');

define('MW_USERFILES', MW_ROOTPATH . MW_USERFILES_DIRNAME . DS);

define("MW_USERFILES_URL", site_url(MW_USERFILES_DIRNAME . '/'));

define("MW_USERFILES_DIR", MW_USERFILES);

define("MODULES_DIR", MW_USERFILES . 'modules' . DS);

define('TEMPLATEFILES_DIRNAME', 'templates');

define('TEMPLATEFILES', MW_USERFILES . TEMPLATEFILES_DIRNAME . DS);

define('MEDIAFILES', MW_USERFILES . 'media' . DS);

define('ELEMENTS_DIR', MW_USERFILES . 'elements' . DS);

define('STYLES_DIR', MW_USERFILES . 'styles' . DS);

define('PLUGINS_DIRNAME', MW_USERFILES . 'plugins' . '/');
if (isset($_SERVER["REMOTE_ADDR"])) {
    define("USER_IP", $_SERVER["REMOTE_ADDR"]);
} else {
    define("USER_IP", '127.0.0.1');

}


$subdir = $_SERVER['SCRIPT_NAME'];

$subdir = dirname($subdir);

$subdir = ltrim($subdir, '/');

$subdir = rtrim($subdir, '/');
if (isset($_SERVER["SERVER_NAME"])) {
    $get_url_dir = $_SERVER["SERVER_NAME"] . (trim($_SERVER["REQUEST_URI"]));
}

//var_Dump( $_SERVER);
//define ( 'SITEURL', 'http://' . $_SERVER ["SERVER_NAME"] . '/' . $subdir . '/' );

$pageURL = 'http';

if (isset($_SERVER["HTTPS"])) {

    if ($_SERVER["HTTPS"] == "on") {

        $pageURL .= "s";
    }
}
if ($mw_config['site_url']) {
    // define ( 'SITEURL', $pageURL . '://' . $mw_config ['site_url'] . '/' . $subdir . '/' );
    define('SITEURL', $mw_config['site_url']);
} else {
    define('SITEURL', site_url());
}

define('SITE_URL', SITEURL);

define('CACHE_FILES_EXTENSION', '.php');

define('CACHE_CONTENT_PREPEND', '<?php exit(); ?>');

define('CACHEDIR_ROOT', dirname((__FILE__)) . DIRECTORY_SEPARATOR . 'cache' . DIRECTORY_SEPARATOR);

define('DATETIME_FORMAT', 'F j g:m a');

define('MW_APPPATH', $application_folder . DIRECTORY_SEPARATOR);
define('MW_APPPATH_FULL', MW_ROOTPATH . MW_APPPATH);
if (!isset($_SERVER["SERVER_NAME"])) {
    $config_file_for_site = MW_ROOTPATH . 'config_localhost' . '.php';

} else {
    $config_file_for_site = MW_ROOTPATH . 'config_' . $_SERVER["SERVER_NAME"] . '.php';

}
//
//var_dump($config_file_for_site);
if (is_file($config_file_for_site)) {
    define('MW_CONFIG_FILE', $config_file_for_site);

} else {
    define('MW_CONFIG_FILE', MW_ROOTPATH . 'config.php');
}

$dnf = CACHEDIR_ROOT;
$md5_conf = 'mw_cache_' . crc32($config_file_for_site);
$cache_main_dir = $dnf . $md5_conf . DIRECTORY_SEPARATOR;

if (is_dir($cache_main_dir) == false) {

    @mkdir($cache_main_dir);
}

//$cache_main_dir = $cache_main_dir . crc32(MW_ROOTPATH) . DIRECTORY_SEPARATOR;

if (is_dir($cache_main_dir) == false) {

    @mkdir($cache_main_dir);
}

define('CACHEDIR', $cache_main_dir);

define('HISTORY_DIR', MW_USERFILES . 'history' . DIRECTORY_SEPARATOR);

define('LIBSPATH', MW_APPPATH . 'libraries' . DIRECTORY_SEPARATOR);
define('DBPATH', 'db' . DS);
define('DBPATH_FULL', MW_ROOTPATH . DBPATH);

define('ADMIN_URL', SITEURL . 'admin');

define('INCLUDES_PATH', MW_ROOTPATH . MW_APPPATH . 'includes' . DS);
//full filesystem path
define('INCLUDES_DIR', INCLUDES_PATH);
//full filesystem path
define('INCLUDES_URL', SITEURL . $application_folder . '/includes/');
//full filesystem path
define('VIEWSPATH', INCLUDES_PATH . 'admin' . DS);
//full filesystem path
define('ADMIN_VIEWS_PATH', INCLUDES_PATH . 'admin' . DS);
//full filesystem path
define('ADMIN_VIEWS_URL', INCLUDES_URL . 'admin');

$media_url = SITEURL;

$media_url = $media_url . MW_USERFILES_DIRNAME . '/media/';

define('MEDIA_URL', $media_url);

$media_url = SITEURL . MW_USERFILES_DIRNAME . '/elements/';

define('ELEMENTS_URL', $media_url);

$media_url = SITEURL . MW_USERFILES_DIRNAME . '/resources/';

define('RESOURCES_URL', $media_url);

$media_url = SITEURL . MW_USERFILES_DIRNAME . '/modules/';

define('MODULES_URL', $media_url);

$media_url = SITEURL . MW_USERFILES_DIRNAME . '/styles/';

define('STYLES_URL', $media_url);

define('RESOURCES_DIR', MW_USERFILES . 'resources' . '/');



if (!isset($mw_site_url)) {
    $mw_site_url = false;
}
function site_url($add_string = false)
{
    global $mw_site_url;
    if ($mw_site_url == false) {
        $pageURL = 'http';
        if (isset($_SERVER["HTTPS"]) and ($_SERVER["HTTPS"] == "on")) {
            $pageURL .= "s";
        }

        $subdir_append = false;
        if (isset($_SERVER['PATH_INFO'])) {
            // $subdir_append = $_SERVER ['PATH_INFO'];
        } elseif (isset($_SERVER['REDIRECT_URL'])) {
            $subdir_append = $_SERVER['REDIRECT_URL'];
        } else {
            //  $subdir_append = $_SERVER ['REQUEST_URI'];
        }

        $pageURL .= "://";
        //error_log(serialize($_SERVER));
        if (isset($_SERVER["SERVER_NAME"]) and isset($_SERVER["SERVER_PORT"]) and $_SERVER["SERVER_PORT"] != "80") {
            $pageURL .= $_SERVER["SERVER_NAME"] . ":" . $_SERVER["SERVER_PORT"];
        } elseif (isset($_SERVER["SERVER_NAME"])) {
            $pageURL .= $_SERVER["SERVER_NAME"];
        } else if (isset($_SERVER["HOSTNAME"])) {
            $pageURL .= $_SERVER["HOSTNAME"];
        }
        $pageURL_host = $pageURL;
        $pageURL .= $subdir_append;

        $d = '';
        if (isset($_SERVER['SCRIPT_NAME'])) {
            $d = dirname($_SERVER['SCRIPT_NAME']);
            $d = trim($d, DIRECTORY_SEPARATOR);
        }

        if ($d == '') {
            $pageURL = $pageURL_host;
        } else {

            $pageURL_host = rtrim($pageURL_host, '/') . '/';
            $d = ltrim($d, '/');
            $d = ltrim($d, DIRECTORY_SEPARATOR);

            $pageURL = $pageURL_host . $d;

        }
        //
        if (isset($_SERVER['QUERY_STRING'])) {
            $pageURL = str_replace($_SERVER['QUERY_STRING'], '', $pageURL);
        }

        if (isset($_SERVER['REDIRECT_URL'])) {
            //  $pageURL = str_replace($_SERVER ['REDIRECT_URL'], '', $pageURL);
        }

        $uz = parse_url($pageURL);
        if (isset($uz['query'])) {
            $pageURL = str_replace($uz['query'], '', $pageURL);
            $pageURL = rtrim($pageURL, '?');
        }

        $url_segs = explode('/', $pageURL);

        $i = 0;
        $unset = false;
        foreach ($url_segs as $v) {
            if ($unset == true and $d != '') {

                unset($url_segs[$i]);
            }
            if ($v == $d and $d != '') {

                $unset = true;
            }

            $i++;
        }
        $url_segs[] = '';
        $mw_site_url = implode('/', $url_segs);

    }
	
	 
    return $mw_site_url . $add_string;
}
