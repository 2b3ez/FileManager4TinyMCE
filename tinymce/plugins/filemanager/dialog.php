<?
include 'config.php';

function deleteDir($dirPath) {
    if (! is_dir($dirPath)) {
        return false;
    }
    if (substr($dirPath, strlen($dirPath) - 1, 1) != '/') {
        $dirPath .= '/';
    }
    $files = glob($dirPath . '*', GLOB_MARK);
    foreach ($files as $file) {
        if (is_dir($file)) {
            deleteDir($file);
        } else {
            unlink($file);
        }
    }
    rmdir($dirPath);
}

if (isset($_GET['fldr']) && !empty($_GET['fldr'])) {
    $subdir = trim($_GET['fldr'],'/') . '/';
}
else
    $subdir = '';

$cur_dir = $upload_dir . $subdir;
$cur_path = $current_path . $subdir;

if (isset($_GET['del_file'])) {
    @unlink($root. $cur_dir . $_GET['del_file']);
}

if (isset($_GET['del_folder'])) {
    @ deleteDir($root. $cur_dir . $_GET['del_folder']);
}

if (isset($_GET['lang']) && $_GET['lang'] != 'undefined') {
    require_once 'lang/' . $_GET['lang'] . '.php';
} else {
    require_once 'lang/en_EN.php';
}
if(!isset($_GET['type'])) $_GET['type']=0;
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
        <meta name="robots" content="noindex,nofollow">
        <title>Administration</title>
        <link href="css/bootstrap.min.css" rel="stylesheet" type="text/css" />
        <link href="css/bootstrap-lightbox.min.css" rel="stylesheet" type="text/css" />
        <link href="css/style.css" rel="stylesheet" type="text/css" />
		<link href="css/dropzone.css" type="text/css" rel="stylesheet" />
        <script type="text/javascript" src="js/jquery.1.9.1.min.js"></script>
        <script type="text/javascript" src="js/bootstrap.min.js"></script>
        <script type="text/javascript" src="js/bootstrap-lightbox.min.js"></script>
		<script type="text/javascript" src="js/dropzone.min.js"></script>
		<script>
	    	var ext_img=new Array('<?php echo implode("','", $ext_img)?>');
	    </script>
		<script type="text/javascript" src="js/include.js"></script>
    </head>
    <body>
		<input type="hidden" id="track" value="<?php echo $_GET['editor']; ?>" />
		<input type="hidden" id="cur_dir" value="<?php echo $cur_dir; ?>" />
		<input type="hidden" id="root" value="<?php echo $root; ?>" />
		<input type="hidden" id="insert_folder_name" value="<?php echo lang_Insert_Folder_Name; ?>" />
		<input type="hidden" id="new_folder" value="<?php echo lang_New_Folder; ?>" />
		
<!----- uploader div start ------->
<div class="uploader">            
	<form action="upload.php" id="my-dropzone" class="dropzone">
		<input type="hidden" name="path" value="<?php echo $cur_path?>"/>
	</form>
	<center><button class="btn btn-large btn-primary close-uploader"><i class="icon-backward icon-white"></i> <?php echo lang_Return_Files_List?></button></center>
	<div class="space10"></div><div class="space10"></div>
</div>
<!----- uploader div start ------->

          <div class="container-fluid">
          
          
<!----- header div start ------->
			<div class="filters"><button class="btn btn-primary upload-btn" style="margin-left:5px;"><i class="icon-upload icon-white"></i> <?php echo  lang_Upload_file?></button> 
			<button class="btn new-folder" style="margin-left:5px;"><i class="icon-folder-open"></i> <?php echo  lang_New_Folder?></button> <div class="pull-right"><?echo lang_Filter?>: &nbsp;&nbsp;
			<input id="select-type-all" name="radio-sort" type="radio" data-item="ff-item-type-all" class="hide" />
                        <label id="ff-item-type-all" for="select-type-all" class="btn btn-info ff-label-type-all"><?php echo lang_All; ?></label>
&nbsp;
                        <input id="select-type-1" name="radio-sort" type="radio" data-item="ff-item-type-1" checked="checked"  class="hide"  />
                        <label id="ff-item-type-1" for="select-type-1" class="btn ff-label-type-1"><?php echo lang_Files; ?></label>
&nbsp;
                        <input id="select-type-2" name="radio-sort" type="radio" data-item="ff-item-type-2" class="hide"  />
                        <label id="ff-item-type-2" for="select-type-2" class="btn ff-label-type-2"><?php echo lang_Images; ?></label>
&nbsp;
                        <input id="select-type-3" name="radio-sort" type="radio" data-item="ff-item-type-3" class="hide"  />
                        <label id="ff-item-type-3" for="select-type-3" class="btn ff-label-type-3"><?php echo lang_Archives; ?></label>
&nbsp;
                        <input id="select-type-4" name="radio-sort" type="radio" data-item="ff-item-type-4" class="hide"  />
                        <label id="ff-item-type-4" for="select-type-4" class="btn ff-label-type-4"><?php echo lang_Videos; ?></label>
&nbsp;
                        <input id="select-type-5" name="radio-sort" type="radio" data-item="ff-item-type-5" class="hide"  />
                        <label id="ff-item-type-5" for="select-type-5" class="btn ff-label-type-5"><?php echo lang_Music; ?></label>
</div>
</div>

<!----- header div end ------->



<!----- breadcrumb div start ------->
				<div class="row-fluid">
				<?php 
				$link="dialog.php?type=".$_GET['type']."&editor=";
				$link.=$_GET['editor'] ? $_GET['editor'] : 'mce_0';
				$link.="&lang=";
				$link.=$_GET['lang'] ? $_GET['lang'] : 'en_EN';
				$link.="&fldr="; 
				?>
				<ul class="breadcrumb">
				<li><a href="<?php echo $link?>"><i class="icon-home"></i></a> <span class="divider">/</span></li>
				<?
					$bc=explode('/',$subdir);
				$tmp_path='';
				if(!empty($bc))
				foreach($bc as $k=>$b){ 
					$tmp_path=$b."/";
					if($k==count($bc)-2){
				?> <li class="active"><?php echo $b?></li><?
					}elseif($b!=""){ ?>
					<li><a href="<?php echo $link.$tmp_path?>"><?php echo $b?></a> <span class="divider">/</span></li>
				<?php }
				}
				?>
				</ul>
			</div>
<!----- breadcrumb div end ------->


                <div class="row-fluid ff-container">
                    <div class="span12 pull-right">
                        <ul class="thumbnails ff-items">
                            <?
                            $class_ext = '';
                            $src = '';
                            $dir = opendir($root . $cur_dir);
                            $i = 0;
							$k=0;
                            if ($_GET['type']==1)
                                $apply = 'apply_img';
                            elseif($_GET['type']==2)
                                $apply = 'apply_link';
							else
                                $apply = 'apply';
                            
                            $files = scandir($root . $cur_dir);
                            
                            //foreach ($files as $file) {
                            foreach ($files as $file) {
                                if (is_dir($root . $cur_dir . $file) && $file != '.' ) {
									if(($i+$k)%6==0 && $i+$k>0){
										?></div><div class="space10"></div><?
									}
									if(($i+$k)%6==0){
										?>
										<div class="row-fluid"><?
									}
                                    $class_ext = 3;
                                    if($file=='..' && trim($subdir) != ''){
                                        $src = explode('/',$subdir);
										unset($src[count($src)-2]);
										$src=implode('/',$src);
                                    }
                                    elseif ($file!='..') {
                                        $src = $subdir . $file;
                                    }
                                    else{
                                        continue;
                                    }
                                    ?>
                                    <li class="span2 ff-item-type-dir">
                                        <div class="boxes thumbnail">
                                            <?php if($file!=".."){ ?>
                                            	<a href="dialog.php?del_folder=<?php echo $file; ?>&type=<?echo $_GET['type']?>&editor=<?php echo $_GET['editor'] ? $_GET['editor'] : 'mce_0'; ?>&lang=<?php echo $_GET['lang'] ? $_GET['lang'] : 'en_EN'; ?>&fldr=<?php echo  $subdir ?>" class="btn erase-button top-right" onclick="return confirm('<?php echo lang_Confirm_Folder_del; ?>');" title="<?php echo lang_Erase?>"><i class="icon-trash"></i></a>
											<?php } ?>
											<a title="<?php echo lang_Open?>" href="dialog.php?type=<?echo $_GET['type']?>&editor=<?php echo $_GET['editor'] ? $_GET['editor'] : 'mce_0'; ?>&lang=<?php echo $_GET['lang'] ? $_GET['lang'] : 'en_EN'; ?>&fldr=<?php echo  $src ?>">
<img class="directory-img"  src="ico/folder<?php if($file=='..') echo "_return"?>.png" alt="folder" />
                                            <h3><?php echo $file ?></h3></a>
                                        </div>
                                    </li>
                                    <?
                                    $k++;
                                }
							}
							foreach ($files as $file) {
                                if ($file != '.' && $file != '..' && !is_dir($root . $cur_dir . $file)) {
									if(($i+$k)%6==0 && $i+$k>0){
										?></div><div class="space10"></div><?
									}
									if(($i+$k)%6==0){
										?>
										<div class="row-fluid"><?
									}
									$is_img=false;
                                    $file_ext = substr(strrchr($file,'.'),1);
									if(in_array($file_ext, $ext)){
									if(in_array($file_ext, $ext_img)){
										 $src = $wwwroot . $cur_dir . $file;
										 $is_img=true;
									}elseif(file_exists('ico/'.strtoupper($file_ext).".png")){
										$src = 'ico/'.strtoupper($file_ext).".png";
									}else{
										$src = "ico/Default.png";
									}

                                    if (in_array($file_ext, $ext_video)) {
                                        $class_ext = 4;
                                    }elseif (in_array($file_ext, $ext_img)) {
                                        $class_ext = 2;
                                    }elseif (in_array($file_ext, $ext_music)) {
                                        $class_ext = 5;
									}elseif (in_array($file_ext, $ext_misc)) {
                                        $class_ext = 3;
									}else{
                                        $class_ext = 1;
									}
                                    ?>
                                    <li class="span2 ff-item-type-<?php echo $class_ext; ?>">
                                        <div class="boxes thumbnail">
											<form action="force_download.php" method="post" class="download-form">
											<input type="hidden" name="path" value="<?php echo $root. $cur_dir. $file?>"/>
											<input type="hidden" name="name" value="<?php echo $file?>"/>

												  <div class="btn-group">
											<button type="submit" title="<?php echo lang_Download?>" class="btn"><i class="icon-download"></i></button>
										  
                                            <?php if($is_img){ ?>
                                            	<a class="btn preview" title="<?php echo lang_Preview?>" data-url="<?php echo $src;?>" data-toggle="lightbox" href="#previewLightbox"><i class=" icon-eye-open"></i></a>
                                            <?php }else{ ?>
                                            	<a class="btn preview disabled"><i class=" icon-eye-open"></i></a>
                                            <?php } ?>
                                            	<a href="dialog.php?del_file=<?php echo $file; ?>&type=<?echo $_GET['type']?>&editor=<?php echo $_GET['editor'] ? $_GET['editor'] : 'mce_0'; ?>&lang=<?php echo $_GET['lang'] ? $_GET['lang'] : 'en_EN'; ?>&fldr=<?php echo  $subdir ?>" class="btn erase-button btn-error" onclick="return confirm('<?php echo lang_Confirm_del; ?>');" title="<?php echo lang_Erase?>"><i class="icon-trash"></i></a>
												  </div>

                                            	</form>
                                            <a href="#" title="<?php echo  lang_Select?>" onclick="<?php echo $apply; ?>('<?php echo $file; ?>')">
 <img data-src="holder.js/140x100" alt="140x100" src="<?php echo $src; ?>" height="100">
                                                <h4><?php echo substr($file, 0, '-' . (strlen($file_ext) + 1)); ?></h4></a>
												  
                                                    
                                        </div>
                                    </li>
                                    <?
                                    $i++;
									}
                                }
                            }
?></div><?
                            closedir($dir);
                            ?>
                        </ul>
                    </div>
                </div>
            </div>
        
	<!----- lightbox div end ------->    
	<div id="previewLightbox" class="lightbox hide fade"  tabindex="-1" role="dialog" aria-hidden="true">
		<div class='lightbox-content'>
			<img id="full-img" src="">
		</div>    
	</div>
	<!----- lightbox div end ------->
</body>
</html>