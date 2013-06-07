<?php
include 'config.php';
include('utils.php');

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
    @unlink( "thumbs/".$subdir.$_GET['del_file']);
}

if (isset($_GET['del_folder'])) {
    @ deleteDir($root. $cur_dir . $_GET['del_folder']);
    @ deleteDir($subdir. $_GET['del_folder']);
}

if (isset($_GET['lang']) && $_GET['lang'] != 'undefined' && is_readable('lang/' . $_GET['lang'] . '.php')) {
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
	    	var allowed_ext=new Array('<?php echo implode("','", $ext)?>');

			//dropzone config
			Dropzone.options.myAwesomeDropzone = {
				dictInvalidFileType: "<?php echo lang_Error_extension;?>",
				dictFileTooBig: "<?php echo lang_Error_Upload; ?>",
				dictResponseError: "SERVER ERROR",
				paramName: "file", // The name that will be used to transfer the file
				maxFilesize: <?php echo $MaxSizeUpload; ?>, // MB
				url: "upload.php",
				accept: function(file, done) {
				var extension=file.name.split('.').pop();
				  if ($.inArray(extension, allowed_ext) > -1) {
				    done();
				  }
				  else { done("<?php echo lang_Error_extension;?>"); }
				}
			};
	    </script>
		<script type="text/javascript" src="js/include.js"></script>
    </head>
    <body>
		<input type="hidden" id="track" value="<?php echo $_GET['editor']; ?>" />
		<input type="hidden" id="cur_dir" value="<?php echo $cur_dir; ?>" />
		<input type="hidden" id="cur_dir_thumb" value="<?php echo "thumbs/".$subdir; ?>" />
		<input type="hidden" id="root" value="<?php echo $root; ?>" />
		<input type="hidden" id="insert_folder_name" value="<?php echo lang_Insert_Folder_Name; ?>" />
		<input type="hidden" id="new_folder" value="<?php echo lang_New_Folder; ?>" />
		<input type="hidden" id="base_url" value="<?php echo $base_url?>"/>
		
<?php if($upload_files){ ?>
<!----- uploader div start ------->
<div class="uploader">            
	<form id="myAwesomeDropzone" class="dropzone">
		<input type="hidden" name="path" value="<?php echo $cur_path?>"/>
		<input type="hidden" name="path_thumb" value="<?php echo "thumbs/".$subdir?>"/>
		<div class="fallback">
	    	<input name="file" type="file" multiple />
	  	</div>
	</form>
	<center><button class="btn btn-large btn-primary close-uploader"><i class="icon-backward icon-white"></i> <?php echo lang_Return_Files_List?></button></center>
	<div class="space10"></div><div class="space10"></div>
</div>
<!----- uploader div start ------->

<?php } ?>		
          <div class="container-fluid">
          
          
<!----- header div start ------->
			<div class="filters">
<?php if($upload_files){ ?>
			<button class="btn btn-primary upload-btn" style="margin-left:5px;"><i class="icon-upload icon-white"></i> <?php echo  lang_Upload_file?></button> 
<?php } ?>		
<?php if($create_folder){ ?>
			<button class="btn new-folder" style="margin-left:5px;"><i class="icon-folder-open"></i> <?php echo  lang_New_Folder?></button> 
<?php } ?>
<?php if($_GET['type']!=1){ ?>
<div class="pull-right"><?echo lang_Filter?>: &nbsp;&nbsp;
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
<?php } ?>
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
				<?php
					$bc=explode('/',$subdir);
				$tmp_path='';
				if(!empty($bc))
				foreach($bc as $k=>$b){ 
					$tmp_path.=$b."/";
					if($k==count($bc)-2){
				?> <li class="active"><?php echo $b?></li><?php
					}elseif($b!=""){ ?>
					<li><a href="<?php echo $link.$tmp_path?>"><?php echo $b?></a> <span class="divider">/</span></li>
				<?php }
				}
				?>
				<li class="pull-right"><a id="refresh" href="dialog.php?type=<?php echo $_GET['type']?>&editor=<?php echo $_GET['editor'] ? $_GET['editor'] : 'mce_0'; ?>&lang=<?php echo $_GET['lang'] ? $_GET['lang'] : 'en_EN'; ?>&fldr=<?php echo $subdir ?>"><i class="icon-refresh"></i></a></li>
				</ul>
			</div>
<!----- breadcrumb div end ------->


                <div class="row-fluid ff-container">
                    <div class="span12 pull-right">
                        <ul class="thumbnails ff-items">
                            <?php
                            $class_ext = '';
                            $src = '';
                            $dir = opendir($root . $cur_dir);
                            $i = 0;
							$k=0;
							$start=false;
							$end=false;
                            if ($_GET['type']==1) 	 $apply = 'apply_img';
                            elseif($_GET['type']==2) $apply = 'apply_link';
                            elseif($_GET['type']>=3) $apply = 'apply_video';
							else				     $apply = 'apply';
                            
                            $files = scandir($root . $cur_dir);
                            
                            foreach ($files as $file) {
                                if (is_dir($root . $cur_dir . $file) && $file != '.' ) {
									//add in thumbs folder if not exist 
									if (!file_exists("thumbs/".$subdir.$file)) create_folder(false,"thumbs/".$subdir.$file);
									if(($i+$k)%6==0 && $i+$k>0 && $end==false){ $end =true;
										?></div><div class="space10"></div><?php
									}else{ $end =false; }
									if(($i+$k)%6==0 && $start==false){ $start=true;
										?>
										<div class="row-fluid"><?php
									}else{ $start=false; }
                                    $class_ext = 3;
                                    if($file=='..' && trim($subdir) != ''){
                                        $src = explode('/',$subdir);
										unset($src[count($src)-2]);
										$src=implode('/',$src);
                                    }
                                    elseif ($file!='..') {
                                        $src = $subdir . $file."/";
                                    }
                                    else{
                                        continue;
                                    }
									
                                    ?>
                                    <li class="span2 ff-item-type-dir">
                                        <div class="boxes thumbnail">
                                            <?php if($file!=".."){ ?>
                                            	<a href="<?php if($delete_folder){ ?>dialog.php?del_folder=<?php echo $file; ?>&type=<?echo $_GET['type']?>&editor=<?php echo $_GET['editor'] ? $_GET['editor'] : 'mce_0'; ?>&lang=<?php echo $_GET['lang'] ? $_GET['lang'] : 'en_EN'; ?>&fldr=<?php echo  $subdir ?><?php }else{ echo '#'; } ?>" class="btn erase-button top-right <?php if(!$delete_folder) echo 'disabled'; ?>" <?php if($delete_folder){ ?>onclick="return confirm('<?php echo lang_Confirm_Folder_del; ?>');"<?php } ?> title="<?php echo lang_Erase?>"><i class="icon-trash"></i></a>
											<?php } ?>
											<a title="<?php echo lang_Open?>" href="dialog.php?type=<?php echo $_GET['type']?>&editor=<?php echo $_GET['editor'] ? $_GET['editor'] : 'mce_0'; ?>&lang=<?php echo $_GET['lang'] ? $_GET['lang'] : 'en_EN'; ?>&fldr=<?php echo $src ?>">
<img class="directory-img"  src="ico/folder<?php if($file=='..') echo "_return"?>.png" alt="folder" />
                                            <h3><?php echo $file ?></h3></a>
                                        </div>
                                    </li>
                                    <?php
                                    $k++;
                                }
							}
							foreach ($files as $file) {
                                if ($file != '.' && $file != '..' && !is_dir($root . $cur_dir . $file)) {
									$is_img=false;
									$is_video=false;
                                    $file_ext = substr(strrchr($file,'.'),1);
									if(in_array($file_ext, $ext)){
									if(in_array($file_ext, $ext_img)){
										 $src = $base_url . $cur_dir . $file;
										 $src_thumb = "thumbs/".$subdir. $file;
										 //add in thumbs folder if not exist 
										$thumb_path=dirname( __FILE__ ). DIRECTORY_SEPARATOR."thumbs". DIRECTORY_SEPARATOR.$subdir.$file;
										 if(!file_exists($thumb_path)) create_img_gd(dirname( __FILE__ ). DIRECTORY_SEPARATOR.$current_path.$subdir.$file, $thumb_path, 156, 78);
										 $is_img=true;
									}elseif(file_exists('ico/'.strtoupper($file_ext).".png")){
										$src = $src_thumb ='ico/'.strtoupper($file_ext).".png";
									}else{
										$src = $src_thumb = "ico/Default.png";
									}

                                    if (in_array($file_ext, $ext_video)) {
                                        $class_ext = 4;
										$is_video=true;
                                    }elseif (in_array($file_ext, $ext_img)) {
                                        $class_ext = 2;
                                    }elseif (in_array($file_ext, $ext_music)) {
                                        $class_ext = 5;
									}elseif (in_array($file_ext, $ext_misc)) {
                                        $class_ext = 3;
									}else{
                                        $class_ext = 1;
									}

									if(!($_GET['type']==1 && !$is_img) && !($_GET['type']>=3 && !$is_video)){


									if(($i+$k)%6==0 && $i+$k>0 && $end==false){ $end=true;
										?></div><div class="space10"></div><?php
									}else{ $end=false; }
									if(($i+$k)%6==0 && $start==false){ $start=true;
										?>
										<div class="row-fluid"><?php
									}else{ $start=false; }
									
                                    ?>
                                    <li class="span2 ff-item-type-<?php echo $class_ext; ?>">
                                        <div class="boxes thumbnail">
											<form action="force_download.php" method="post" class="download-form">
											<input type="hidden" name="path" value="<?php echo $root. $cur_dir. $file?>"/>
											<input type="hidden" name="name" value="<?php echo $file?>"/>

												  <div class="btn-group toolbox">
											<button type="submit" title="<?php echo lang_Download?>" class="btn"><i class="icon-download"></i></button>
                                            <?php if($is_img){ ?>
                                            	<a class="btn preview" title="<?php echo lang_Preview?>" data-url="<?php echo $src;?>" data-toggle="lightbox" href="#previewLightbox"><i class=" icon-eye-open"></i></a>
                                            <?php }else{ ?>
                                            	<a class="btn preview disabled"><i class=" icon-eye-open"></i></a>
                                            <?php } ?>
                                            	<a href="<?php if($delete_file){ ?>dialog.php?del_file=<?php echo $file; ?>&type=<?php echo $_GET['type']?>&editor=<?php echo $_GET['editor'] ? $_GET['editor'] : 'mce_0'; ?>&lang=<?php echo $_GET['lang'] ? $_GET['lang'] : 'en_EN'; ?>&fldr=<?php echo  $subdir ?> <?php }else{ echo '#'; } ?>" class="btn erase-button <?php if(!$delete_file) echo 'disabled'; ?>" <?php if($delete_file){ ?>onclick="return confirm('<?php echo lang_Confirm_del; ?>');"<?php } ?> title="<?php echo lang_Erase?>"><i class="icon-trash"></i></a>
												  </div>

                                            	</form>
                                            <a href="#" title="<?php echo  lang_Select?>" onclick="<?php echo $apply."('".$file."',".$_GET['type'].")"; ?>">
 <img data-src="holder.js/140x100" alt="140x100" src="<?php echo $src_thumb; ?>" height="100">
                                                <h4><?php echo substr($file, 0, '-' . (strlen($file_ext) + 1)); ?></h4></a>
												  
                                                    
                                        </div>
                                    </li>
                                    <?php
                                    $i++;
									}
									}
                                }
                            }
?></div><?php
                            closedir($dir);
                            ?>
                        </ul>
                    </div>
                </div>
            </div>
        
	<!----- lightbox div start ------->    
	<div id="previewLightbox" class="lightbox hide fade"  tabindex="-1" role="dialog" aria-hidden="true">
		<div class='lightbox-content'>
			<img id="full-img" src="">
		</div>    
	</div>
	<!----- lightbox div end ------->

	<!----- loading div start ------->  
	<div id="loading_container" style="display:none;">
		<div id="loading" style="background-color:#000; position:fixed; width:100%; height:100%; top:0px; left:0px;z-index:100000"></div>
		<img id="loading_animation" src="img/storing_animation.gif" alt="loading" style="z-index:10001; margin-left:-32px; margin-top:-32px; position:fixed; left:50%; top:50%"/>
	</div>
	<!----- loading div end ------->  
</body>
</html>