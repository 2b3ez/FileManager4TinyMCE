<?php
include('utils.php');

$path=$_POST['path'];
$path_thumbs=$_POST['path_thumb'];

deleteDir($path);
deleteDir($path_thumbs);

?>
