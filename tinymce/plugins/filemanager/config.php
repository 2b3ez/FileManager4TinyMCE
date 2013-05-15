<?
$root = rtrim($_SERVER['DOCUMENT_ROOT'],'/');

$wwwroot = '';
<<<<<<< HEAD
$upload_dir = '/source/'; // dir for upload file
$MaxSizeUpload=1000000; // 1Mo
$ext=array('png','jpg','jpeg','gif','pdf','zip','rar','doc','docx','xls','xlsx','txt','csv'); //extensions allowed
=======
$upload_dir = '/tinymce/source/'; // dir for upload file
$current_path = '../../../../source/'; // dir for upload file
$MaxSizeUpload=1000000000; // 1Mo

// extensions for filemanager
$ext_img = array('jpg', 'jpeg', 'png', 'gif', 'bmp', 'tiff');
$ext_file = array('doc', 'docx', 'pdf', 'xls', 'xlsx', 'txt', 'csv','html','psd','sql','php','log','fla','xml','ade','adp','ppt','pptx');
$ext_video = array('mov', 'mpeg', 'mp4', 'avi', 'mpg','wma');
$ext_music = array('mp3', 'm4a', 'ac3', 'aiff', 'mid');
$ext_misc = array('zip', 'rar',);


$ext=array_merge($ext_img, $ext_file, $ext_misc, $ext_video,$ext_music); //extensions allowed
>>>>>>> v2.0

// extensions for filemanager
$ext_img = array('jpg', 'jpeg', 'png', 'gif', 'bmp', 'tiff');
$ext_file = array('doc', 'docx', 'pdf', 'xls', 'xlsx', 'txt', 'csv');
$ext_misc = array('zip', 'rar');

?>
