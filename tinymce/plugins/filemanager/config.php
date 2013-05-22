<?php 
$root = rtrim($_SERVER['DOCUMENT_ROOT'],'/');
$base_url="http://localhost"; //url base of site if you want only relative url leave empty
$upload_dir = '/tinymce/source/'; // path from base_url to upload base dir
$current_path = '../../../../source/'; // relative path to dir for upload file
$MaxSizeUpload=1000; //Mb

// extensions for filemanager
$ext_img = array('jpg', 'jpeg', 'png', 'gif', 'bmp', 'tiff');
$ext_file = array('doc', 'docx', 'pdf', 'xls', 'xlsx', 'txt', 'csv','html','psd','sql','log','fla','xml','ade','adp','ppt','pptx');
$ext_video = array('mov', 'mpeg', 'mp4', 'avi', 'mpg','wma');
$ext_music = array('mp3', 'm4a', 'ac3', 'aiff', 'mid');
$ext_misc = array('zip', 'rar',);

$ext=array_merge($ext_img, $ext_file, $ext_misc, $ext_video,$ext_music); //allowed extensions

?>
