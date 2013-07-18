<?php 

if($_SESSION["verify"] != "FileManager4TinyMCE") die('forbiden');

function deleteDir($dir) {
    if (!file_exists($dir)) return true;
    if (!is_dir($dir)) return unlink($dir);
    foreach (scandir($dir) as $item) {
        if ($item == '.' || $item == '..') continue;
        if (!deleteDir($dir.DIRECTORY_SEPARATOR.$item)) return false;
    }
    return rmdir($dir);
}

function create_img_gd($imgfile, $imgthumb, $newwidth, $newheight="") {
    require_once('php_image_magician.php');  
    $magicianObj = new imageLib($imgfile);
    // *** Resize to best fit then crop
    $magicianObj -> resizeImage($newwidth, $newheight, 'crop');  

    // *** Save resized image as a PNG
    $magicianObj -> saveImage($imgthumb);
}

function makeSize($size) {
   $units = array('B','KB','MB','GB','TB');
   $u = 0;
   while ( (round($size / 1024) > 0) && ($u < 4) ) {
     $size = $size / 1024;
     $u++;
   }
   return (number_format($size, 1, ',', '') . " " . $units[$u]);
}

function create_folder($path=false,$path_thumbs=false){
	$oldumask = umask(0); 
	if ($path && !file_exists($path))
		mkdir($path, 0777); // or even 01777 so you get the sticky bit set 
	if($path_thumbs && !file_exists($path_thumbs)) 
		mkdir($path_thumbs, 0777); // or even 01777 so you get the sticky bit set 
	umask($oldumask);
}

?>