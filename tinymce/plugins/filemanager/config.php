<?php 
$root = rtrim($_SERVER['DOCUMENT_ROOT'],'/');


$base_url="http://localhost"; //url base of site if you want only relative url leave empty
$upload_dir = '/tinymce/source/'; // path from base_url to upload base dir
$current_path = '../../../../source/'; // relative path from filemanager folder to dir for upload file

$MaxSizeUpload=100; //Mb

//**********************
//Image resizing config
//**********************
//If you set true $image_resizing the script convert all images uploaded in image_width x image_height resolution
$image_resizing=false;
$image_width=400;
$image_height=400;

//******************
//Permits config
//******************
$delete_file=true;
$create_folder=true;
$delete_folder=true;


//**********************
//Allowed extensions
//**********************
$ext_img = array('jpg', 'jpeg', 'png', 'gif', 'bmp', 'tiff'); //Images
$ext_file = array('doc', 'docx', 'pdf', 'xls', 'xlsx', 'txt', 'csv','html','psd','sql','log','fla','xml','ade','adp','ppt','pptx'); //Files
$ext_video = array('mov', 'mpeg', 'mp4', 'avi', 'mpg','wma'); //Videos
$ext_music = array('mp3', 'm4a', 'ac3', 'aiff', 'mid'); //Music
$ext_misc = array('zip', 'rar','gzip'); //Archives


$ext=array_merge($ext_img, $ext_file, $ext_misc, $ext_video,$ext_music); //allowed extensions

?>
