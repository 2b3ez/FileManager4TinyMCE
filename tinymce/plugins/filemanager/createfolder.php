<?php
if (isset($_POST['lang'])) {
    require_once 'lang/' . $_POST['lang'] . '.php';
} else {
    require_once 'lang/en_EN.php';
}

$path=$_POST['path'];
$path_thumb=$_POST['path_thumb'];

if (!file_exists($path) && !file_exists($path_thumb)) {

    $oldumask = umask(0); 
	mkdir($path, 0777); // or even 01777 so you get the sticky bit set 
	mkdir($path_thumb, 0777); // or even 01777 so you get the sticky bit set 
	umask($oldumask);

}else{
	echo lang_Existing_Folder;
}
?>
