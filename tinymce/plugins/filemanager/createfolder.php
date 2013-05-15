<?
if (isset($_POST['lang'])) {
    require_once 'lang/' . $_POST['lang'] . '.php';
} else {
    require_once 'lang/en_EN.php';
}

$path=$_POST['path'];
if (!file_exists($path)) {

    $oldumask = umask(0); 
	mkdir($path, 0777); // or even 01777 so you get the sticky bit set 
	umask($oldumask);

}else{
	echo lang_Existing_Folder;
}
?>
