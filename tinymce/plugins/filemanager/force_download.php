<?php

session_start();
if($_SESSION["verify"] != "FileManager4TinyMCE") die('forbiden');
include 'config.php';

$path=$_POST['path'];
$name=$_POST['name'];

if(strpos($path,$upload_dir)===FALSE) die('wrong path');

header('Pragma: private');
header('Cache-control: private, must-revalidate');
header("Content-Type: application/octet-stream");
header("Content-Length: " .(string)(filesize($path)) );
header('Content-Disposition: attachment; filename="'.($name).'"');
readfile($path);
exit;
?>