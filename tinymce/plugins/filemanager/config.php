<?php 
$root = rtrim($_SERVER['DOCUMENT_ROOT'],'/');
$base_url="http://localhost"; //url base of site if you want only relative url leave empty
$upload_dir = '/tinymce/source/'; // path from base_url to upload base dir
$current_path = '../../../../source/'; // relative path to dir for upload file

//THUMBNAILS 
//This folder must is out of file folder because should not be seen inside the filemanager
$current_path_thumb = '../../../../thumb/'; // relative path to dir for thumbnails storage file [only use to images displaying]
$upload_dir_thumb = '/tinymce/thumb/'; // path from base_url to thumbnails base dir

$MaxSizeUpload=100; //Mb

//**********************
//Image resizing config
//*********************
//If you set true $image_resizing the script conver all images uploaded in image_width x image_height resolutions
$image_resizing=true;
$image_width=600;
$image_height=400;

//******************
//Permits config
//******************
$delete_file=true;
$create_folder=true;
$delete_folder=true;


// extensions for filemanager
$ext_img = array('jpg', 'jpeg', 'png', 'gif', 'bmp', 'tiff');
$ext_file = array('doc', 'docx', 'pdf', 'xls', 'xlsx', 'txt', 'csv','html','psd','sql','log','fla','xml','ade','adp','ppt','pptx');
$ext_video = array('mov', 'mpeg', 'mp4', 'avi', 'mpg','wma');
$ext_music = array('mp3', 'm4a', 'ac3', 'aiff', 'mid');
$ext_misc = array('zip', 'rar',);

$ext=array_merge($ext_img, $ext_file, $ext_misc, $ext_video,$ext_music); //allowed extensions

?>
