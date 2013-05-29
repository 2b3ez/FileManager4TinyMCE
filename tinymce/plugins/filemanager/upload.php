<?php 
include('config.php');
include('utils.php');

$ds          = DIRECTORY_SEPARATOR; 
 
$storeFolder = $_POST['path'];
$storeFolderThumb = $_POST['path_thumb'];  
 
if (!empty($_FILES)) {
     
    $tempFile = $_FILES['file']['tmp_name'];   
      
    $targetPath = dirname( __FILE__ ) . $ds. $storeFolder . $ds; 
    $targetPathThumb = dirname( __FILE__ ) . $ds. $storeFolderThumb . $ds; 
     
    $targetFile =  $targetPath. $_FILES['file']['name']; 
    $targetFileThumb =  $targetPathThumb. $_FILES['file']['name']; 
 
    if(in_array(substr(strrchr($_FILES['file']['name'],'.'),1),$ext_img)) $is_img=true;
	else $is_img=false;

	if($is_img){
		create_img_gd($tempFile, $targetFileThumb, 156, 78);

		if($image_resizing)
			create_img_gd($tempFile, $targetFile, $image_width, $image_height);
		else
			move_uploaded_file($tempFile,$targetFile);
	}else{
		move_uploaded_file($tempFile,$targetFile);
	}
	
     
}
?>      