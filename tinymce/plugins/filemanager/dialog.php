<?php

session_start();
$_SESSION["verify"] = "FileManager4TinyMCE";

if(isset($_POST['submit'])){

include('upload.php');

}else{

include 'config.php';
include('utils.php');

if(isset($_GET['popup'])) $popup= $_GET['popup']; else $popup=0;

if (isset($_GET['fldr']) && !empty($_GET['fldr'])) {
    $subdir = trim($_GET['fldr'],'/') . '/';
}
else
    $subdir = '';

/***
 *SUB-DIR CODE
 ***/
$subfolder = '';
if(isset($_GET['subfolder']) && !empty($_GET['subfolder'])) {
    if($_GET['subfolder'] != "undefined") $subfolder = $_GET['subfolder'];
    $cur_dir = $upload_dir . $subfolder . '/' . $subdir;
    $cur_path = $current_path . $subfolder .'/'. $subdir;
    $thumbs_path = 'thumbs/' . $subfolder . '/';
    if (!file_exists($thumbs_path.$subdir)) create_folder(false,$thumbs_path.$subdir);
}
else {
    $cur_dir = $upload_dir . $subdir;
    $cur_path = $current_path . $subdir;
    $thumbs_path = 'thumbs/';
}


if (isset($_GET['lang']) && $_GET['lang'] != 'undefined' && is_readable('lang/' . $_GET['lang'] . '.php')) {
    require_once 'lang/' . $_GET['lang'] . '.php';
} else {
    require_once 'lang/en_EN.php';
}
if(!isset($_GET['type'])) $_GET['type']=0;
if(!isset($_GET['field_id'])) $_GET['field_id']='';


?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
        <meta name="robots" content="noindex,nofollow">
        <title>FileManager</title>
        <link href="css/bootstrap.min.css" rel="stylesheet" type="text/css" />
        <link href="css/bootstrap-lightbox.min.css" rel="stylesheet" type="text/css" />
        <link href="css/style.css" rel="stylesheet" type="text/css" />
	<link href="css/dropzone.css" type="text/css" rel="stylesheet" />
	<!--[if lt IE 8]><style>
	.img-container span {
	    display: inline-block;
	    height: 100%;
	}
	</style><![endif]-->
        <script type="text/javascript" src="js/jquery.1.9.1.min.js"></script>
        <script type="text/javascript" src="js/bootstrap.min.js"></script>
        <script type="text/javascript" src="js/bootstrap-lightbox.min.js"></script>
	<script type="text/javascript" src="js/dropzone.min.js"></script>
	<script type="text/javascript" src="js/jquery.touchSwipe.min.js"></script>
	<script src="js/modernizr.custom.js"></script>
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
		    var extension=file.name.split('.').pop().toLowerCase();
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
		<input type="hidden" id="popup" value="<?php echo $popup; ?>" />
		<input type="hidden" id="track" value="<?php echo $_GET['editor']; ?>" />
		<input type="hidden" id="cur_dir" value="<?php echo $cur_dir; ?>" />
		<input type="hidden" id="cur_dir_thumb" value="<?php echo $thumbs_path.$subdir; ?>" />
		<input type="hidden" id="root" value="<?php echo $root; ?>" />
		<input type="hidden" id="insert_folder_name" value="<?php echo lang_Insert_Folder_Name; ?>" />
		<input type="hidden" id="new_folder" value="<?php echo lang_New_Folder; ?>" />
		<input type="hidden" id="base_url" value="<?php echo $base_url?>"/>
		
<?php if($upload_files){ ?>
<!----- uploader div start ------->
<div class="uploader">    
	<form action="dialog.php" method="post" enctype="multipart/form-data" id="myAwesomeDropzone" class="dropzone">
		<input type="hidden" name="path" value="<?php echo $cur_path?>"/>
		<input type="hidden" name="path_thumb" value="<?php echo $thumbs_path.$subdir?>"/>
		<div class="fallback">
			<?php echo  lang_Upload_file?>:<br/>
			<input name="file" type="file" />
			<input type="hidden" name="fldr" value="<?php echo $_GET['fldr']?>"/>
			<input type="hidden" name="type" value="<?php echo $_GET['type']?>"/>
			<input type="hidden" name="field_id" value="<?php echo $_GET['field_id']?>"/>
			<input type="hidden" name="popup" value="<?php echo $popup; ?>"/>
			<input type="hidden" name="editor" value="<?php echo $_GET['editor']?>"/>
			<input type="hidden" name="lang" value="<?php echo $_GET['lang']?>"/>
                        <input type="hidden" name="subfolder" value="<?php echo $_GET['subfolder']?>"/>
			<input type="submit" name="submit" value="OK" />
		</div>
	</form>
	<center><button class="btn btn-large btn-inverse close-uploader"><i class="icon-backward icon-white"></i> <?php echo lang_Return_Files_List?></button></center>
	<div class="space10"></div><div class="space10"></div>
</div>
<!----- uploader div start ------->

<?php } ?>		
          <div class="container-fluid">
          
          
<!----- header div start ------->
			<div class="filters">
			    <div class="row-fluid">
				<div class="span4">
				    <?php if($upload_files){ ?>
							    <button class="btn btn-inverse upload-btn" style="margin-left:5px;"><i class="icon-upload icon-white"></i> <?php echo  lang_Upload_file?></button> 
				    <?php } ?>
				    <?php if($create_folder){ ?>
							    <button class="btn new-folder" style="margin-left:5px;"><i class="icon-folder-open"></i> <?php echo  lang_New_Folder?></button> 
				    <?php } ?>
				</div>
				<div class="span8 pull-right">
				    <?php if($_GET['type']==2 || $_GET['type']==0){ ?>
				    <div class="pull-right"><?php echo lang_Filter; ?> : 
							    <input id="select-type-all" name="radio-sort" type="radio" data-item="ff-item-type-all" class="hide" />
							    <label id="ff-item-type-all" for="select-type-all" class="btn btn-inverse ff-label-type-all"><?php echo lang_All; ?></label>
							    <input id="select-type-1" name="radio-sort" type="radio" data-item="ff-item-type-1" checked="checked"  class="hide"  />
							    <label id="ff-item-type-1" for="select-type-1" class="btn ff-label-type-1"><?php echo lang_Files; ?></label>
							    <input id="select-type-2" name="radio-sort" type="radio" data-item="ff-item-type-2" class="hide"  />
							    <label id="ff-item-type-2" for="select-type-2" class="btn ff-label-type-2"><?php echo lang_Images; ?></label>
							    <input id="select-type-3" name="radio-sort" type="radio" data-item="ff-item-type-3" class="hide"  />
							    <label id="ff-item-type-3" for="select-type-3" class="btn ff-label-type-3"><?php echo lang_Archives; ?></label>
							    <input id="select-type-4" name="radio-sort" type="radio" data-item="ff-item-type-4" class="hide"  />
							    <label id="ff-item-type-4" for="select-type-4" class="btn ff-label-type-4"><?php echo lang_Videos; ?></label>
							    <input id="select-type-5" name="radio-sort" type="radio" data-item="ff-item-type-5" class="hide"  />
							    <label id="ff-item-type-5" for="select-type-5" class="btn ff-label-type-5"><?php echo lang_Music; ?></label>
				    </div>
				    <?php } ?>
				</div>
			    </div>


</div>

<!----- header div end ------->



    <!----- breadcrumb div start ------->
    <div class="row-fluid">
	<?php 
	$link="dialog.php?type=".$_GET['type']."&editor=";
	$link.=$_GET['editor'] ? $_GET['editor'] : 'mce_0';
	$link.="&popup=".$popup."&lang=";
	$link.=$_GET['lang'] ? $_GET['lang'] : 'en_EN';
	$link.="&field_id=";
	$link.=$_GET['field_id'] ? $_GET['field_id'] : '';
	$link.="&subfolder=".$subfolder;
	$link.="&fldr="; 
	?>
	<ul class="breadcrumb">
	<li class="pull-left"><a href="<?php echo $link?>"><i class="icon-home"></i></a></li><li><span class="divider">/</span></li>
	<?php
		$bc=explode('/',$subdir);
	$tmp_path='';
	if(!empty($bc))
	foreach($bc as $k=>$b){ 
		$tmp_path.=$b."/";
		if($k==count($bc)-2){
	?> <li class="active"><?php echo $b?></li><?php
		}elseif($b!=""){ ?>
		<li><a href="<?php echo $link.$tmp_path?>"><?php echo $b?></a></li><li><span class="divider">/</span></li>
	<?php }
	}
	?>
	<li class="pull-right"><a id="refresh" href="dialog.php?type=<?php echo $_GET['type']?>&editor=<?php echo $_GET['editor'] ? $_GET['editor'] : 'mce_0'; ?>&subfolder=<?php echo $subfolder ?>&popup=<?php echo $popup;?>&field_id=<?php echo $_GET['field_id'] ? $_GET['field_id'] : '';?>&lang=<?php echo $_GET['lang'] ? $_GET['lang'] : 'en_EN'; ?>&fldr=<?php echo $subdir ?>&<?php echo uniqid() ?>"><i class="icon-refresh"></i></a></li>
	</ul>
    </div>
    <!----- breadcrumb div end ------->


    <div class="row-fluid ff-container">
	<div class="span12">
	    <?php if(@opendir($root . $cur_dir)===FALSE){ ?>
	    <br/>
	    <div class="alert alert-error">There is an error! The root folder not exist. </div> 
	    <?php }else{ ?>
	    <h4 id="help">Swipe the name of file/folder to show options</h4>
		    
	    <!--ul class="thumbnails ff-items"-->
	    <ul class="grid cs-style-2">
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
		elseif($_GET['type']==0 && $_GET['field_id']=='') $apply = 'apply_none';
		elseif($_GET['type']==3 || $_GET['type']==4 || $_GET['type']==5) $apply = 'apply_video';
		else				     $apply = 'apply';
		
		$files = scandir($root . $cur_dir);
		
		foreach ($files as $file) {
		    if (is_dir($root . $cur_dir . $file) && ($file != '.' && !($file == '..' && $subdir=='')) ) {
			//add in thumbs folder if not exist 
			if (!file_exists($thumbs_path.$subdir.$file)) create_folder(false,$thumbs_path.$subdir.$file);
			$class_ext = 3;			
			if($file=='..' && trim($subdir) != '' ){
			    $src = explode('/',$subdir);
			    unset($src[count($src)-2]);
			    $src=implode('/',$src);
			}
			elseif ($file!='..') {
			    $src = $subdir . $file."/";
			}
			  
			?>
			<li>
				<figure>
				    <a title="<?php echo lang_Open?>"
				    href="dialog.php?type=<?php echo $_GET['type']?>&subfolder=<?php echo $subfolder ?>&editor=<?php echo $_GET['editor'] ? $_GET['editor'] : 'mce_0'; ?>&popup=<?php echo $popup;?>&field_id=<?php echo $_GET['field_id'] ? $_GET['field_id'] : '';?>&lang=<?php echo $_GET['lang'] ? $_GET['lang'] : 'en_EN'; ?>&fldr=<?php echo $src ?>&<?php echo uniqid() ?>">
			<?php if($file==".."){ ?>
				    <div class="img-precontainer">
					<div class="img-container directory"><span></span>
					<img class="directory-img"  src="ico/folder<?php if($file=='..') echo "_return"?>.png" alt="folder" />
					</div>
					</div>
					</a>
				    
			<?php }else{ ?>
					
					<div class="img-precontainer">
					<div class="img-container directory"><span></span>
					<img class="directory-img"  src="ico/folder<?php if($file=='..') echo "_return"?>.png" alt="folder" />
					</div>
					</div>
					</a>
				    <div class="box">
					<h4><?php echo $file ?></h4>
				    </div>
				    <figcaption>
					    <a href="javascript:void('')"
						class="erase-button"
						<?php if($delete_folder){ ?>onclick="if(confirm('<?php echo lang_Confirm_Folder_del; ?>')){ delete_folder('<?php echo $root. $cur_dir .$file; ?>','<?php echo $thumbs_path.$subdir .$file; ?>'); $(this).parent().parent().parent().hide(200); return false;}"<?php } ?> title="<?php echo lang_Erase?>">
					    <i class="icon-trash <?php if(!$delete_folder) echo 'icon-white'; ?>"></i>
					    </a>
				    </figcaption>
			<?php } ?>
			    </figure>
			</li>
			<?php
			$k++;
		    }
		    }
		    foreach ($files as $nu=>$file) {
			if ($file != '.' && $file != '..' && !is_dir($root . $cur_dir . $file)) {
			    $is_img=false;
			    $is_video=false;
			    $show_original=false;
			    $file_ext = strtolower(substr(strrchr($file,'.'),1));
			    if(in_array($file_ext, $ext)){
			    if(in_array($file_ext, $ext_img)){
				$src = $base_url . $cur_dir . $file;
				$src_thumb = $thumbs_path.$subdir. $file;
				//add in thumbs folder if not exist 
				$thumb_path=dirname( __FILE__ ).DIRECTORY_SEPARATOR."thumbs".DIRECTORY_SEPARATOR.$subfolder.DIRECTORY_SEPARATOR.$subdir.$file;
				if(!file_exists($thumb_path)) create_img_gd(dirname( __FILE__ ). DIRECTORY_SEPARATOR.$current_path.$subfolder.DIRECTORY_SEPARATOR.$subdir.$file, $thumb_path, 122, 91);
				$is_img=true;
				//check if is smaller tha thumb
				$info=getimagesize(dirname( __FILE__ ). DIRECTORY_SEPARATOR.$current_path.$subfolder.DIRECTORY_SEPARATOR.$subdir.$file);
				if($info[0]<122 && $info[2]<91){
				    $src_thumb=$current_path.$subfolder.DIRECTORY_SEPARATOR.$subdir.$file;
				    $show_original=true;
				}
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

			    if((!($_GET['type']==1 && !$is_img) && !($_GET['type']>=3 && !$is_video))){
?>
			    <li class="ff-item-type-<?php echo $class_ext; ?>">
				<figure>
					<a href="javascript:void('');" title="<?php echo  lang_Select?>" onclick="<?php echo $apply."('".$file."',".$_GET['type'].",'".$_GET['field_id']."');"; ?>">
					<div class="img-precontainer">
					<div class="img-container"><span></span>
					<img data-src="holder.js/122x91" alt="image" <?php echo $show_original ? "class='original'" : "" ?> src="<?php echo $src_thumb; ?>">
					</div>
					</div>
					</a>	
					<div class="box">				
					<h4><?php echo substr($file, 0, '-' . (strlen($file_ext) + 1)); ?></h4>

					</div>
					<figcaption>
					    <form action="force_download.php" method="post" class="download-form" id="form<?php echo $nu; ?>">
						<input type="hidden" name="path" value="<?php echo $root. $cur_dir. $file?>"/>
						<input type="hidden" name="name" value="<?php echo $file?>"/>
						
						<a title="<?php echo lang_Download?>" class="" href="javascript:void('');" onclick="$('#form<?php echo $nu; ?>').submit();"><i class="icon-download"></i></a>
					    <?php if($is_img){ ?>
					    <a class="preview" title="<?php echo lang_Preview?>" data-url="<?php echo $src;?>" data-toggle="lightbox" href="#previewLightbox"><i class=" icon-eye-open"></i></a>
					    <?php }else{ ?>
					    <a class="preview disabled"><i class="icon-eye-open icon-white"></i></a>
					    <?php } ?>
					    <a href="javascript:void('');" class="erase-button"
					    <?php if($delete_file){ ?>onclick=" if(confirm('<?php echo lang_Confirm_del; ?>')){ delete_file('<?php echo $root. $cur_dir .$file; ?>','<?php echo $thumbs_path.$subdir .$file; ?>'); $(this).parent().parent().parent().parent().hide(200); return false;}"<?php } ?> title="<?php echo lang_Erase?>"><i class="icon-trash <?php if(!$delete_file) echo 'icon-white'; ?>"></i></a>
					    </form>
					</figcaption>
				</figure>
				
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
	    <?php } ?>
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
<?php } ?>
