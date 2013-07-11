<?php
include('utils.php');

$path=$_POST['path'];
$path_thumbs=$_POST['path_thumb'];

unlink($path);
unlink($path_thumbs);

?>
