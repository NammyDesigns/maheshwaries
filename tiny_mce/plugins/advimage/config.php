\<?php

// As default, the uploaded image will be resized to this size
define('DEFAULT_IMG_WIDTH', 1200);

// There will in addition to the resized image be created a thumbnail. This is the thumbnail size
define('DEFAULT_THUMB_WIDTH', 100);

// The quality of the resized image - 0 = lowest -> 100 = highest
define('IMAGE_QUALITY', 70);

// Define the current location of the config.php file
define('CONF_PATH','jscripts/tiny_mce/plugins/advimage/config.php');

$thisFile = str_replace('\\', '/', __FILE__);
$docRoot = $_SERVER['DOCUMENT_ROOT'];
$webRoot  = str_replace(array($docRoot, CONF_PATH), '', $thisFile);
$srvRoot  = str_replace(CONF_PATH, '', $thisFile);

if(substr($webRoot, 0,1) == "/"){
  define('WEB_ROOT', $webRoot); 
}else{
  define('WEB_ROOT', '/'.$webRoot);
}

define('SRV_ROOT', $srvRoot);

// When managing the images - this in the path to the resized image
define('IMG_PATH', SRV_ROOT.'userdata/uploadedfiles'); 
define('IMG_PATH_NEW', SRV_ROOT.'userdata/uploadedfiles/'); 
// When uploading the image - the original will be uploaded, then deleted from this dir
define('IMG_PATH_TEMP', SRV_ROOT.'userdata/uploadedfiles/temp/');

// This is the actual path to the image in the article
define('IMG_PATH_LIVE', WEB_ROOT.'userdata/uploadedfiles/'); 
define('IMG_PATH_LIVE_NEW', '../../../../userdata/uploadedfiles/'); 
// Every directory will have a subfolder containing thumbnails. This is the subfolders name. 
define('THUMB_DIR', ' thumbs/');
define('THUMB_DIR_NEW', 'thumbs/');
// Information in the upload section
define('UPLOAD_INFO', 'Supported image format: .png, .jpg, .gif. For best quality, image should be a minimum of 500px width and be under 2 MB.');
?>
