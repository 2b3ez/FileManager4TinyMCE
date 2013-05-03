<?
$root = rtrim($_SERVER['DOCUMENT_ROOT'],'/');

$wwwroot = '';
$upload_dir = '/source/'; // dir for upload file
$MaxSizeUpload=1000000; // 1Mo
$ext=array('png','jpg','jpeg','gif','pdf','zip','rar','doc','docx','xls','xlsx','txt','csv'); //extensions allowed

// extensions for filemanager
$ext_img = array('jpg', 'jpeg', 'png', 'gif', 'bmp', 'tiff');
$ext_file = array('doc', 'docx', 'pdf', 'xls', 'xlsx', 'txt', 'csv');
$ext_misc = array('zip', 'rar');

?>
