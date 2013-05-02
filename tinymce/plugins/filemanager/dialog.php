<?
include 'config.php';

if (isset($_GET['del_file'])) {
    @unlink($upload_dir . $_GET['del_file']);
}
if (isset($_GET['lang']) && $_GET['lang'] != 'undefined') {
    require_once 'lang/' . $_GET['lang'] . '.php';
} else {
    require_once 'lang/en_EN.php';
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
        <meta name="robots" content="noindex,nofollow">
            <title>Administration</title>
            <link href="css/fineuploader-3.5.0.css" rel="stylesheet" type="text/css" />
            <link href="css/bootstrap.min.css" rel="stylesheet" type="text/css" />
            <link href="css/style.css" rel="stylesheet" type="text/css" />
            <script type="text/javascript" src="js/jquery.1.9.1.min.js"></script>
            <script type="text/javascript" src="js/bootstrap.min.js"></script>
            <script type="text/javascript" src="js/jquery.fineuploader-3.5.0.min.js"></script>
            <script>
                function createUploader() {
                    var uploader = new qq.FineUploader({
                        element: document.getElementById('bootstrapped-fine-uploader'),
                        multiple: false,
                        request: {
                            endpoint: 'upload.php',
                            params: {
                                lang : '<? echo $_GET['lang'] ? $_GET['lang'] : 'en_EN'; ?>'
                            }
                        },
                        dragAndDrop: {
                            disableDefaultDropzone: true
                        },
                        text: {
                            uploadButton: '<i class="icon-upload icon-white"></i> <? echo lang_Upload_file; ?>'
                        },
                        template: '<div class="qq-uploader">' +
                            '<div class="qq-upload-button btn btn-primary pull-left" style="padding:8px;">{uploadButtonText}</div>' +
                            '<div class="pull-right span9"><span class="qq-drop-processing"><span>{dropProcessingText}</span><span class="qq-drop-processing-spinner"></span></span>' +
                            '<ul class="qq-upload-list" style="text-align: center;"></ul></div>' +
                            '</div>',
                        fileTemplate: '<li>' +
                            '<div class="qq-progress-container progress progress-warning progress-striped active"><div class="qq-progress-bar bar"></div></div>' +
                            '<span class="qq-upload-spinner"></span>' +
                            '<span class="qq-upload-finished"></span>' +
                            '<span class="qq-upload-file"></span>' +
                            '<span class="qq-upload-size"></span>' +
                            '<a class="qq-upload-cancel" href="#">{cancelButtonText}</a>' +
                            '<a class="qq-upload-retry" href="#">{retryButtonText}</a>' +
                            '<a class="qq-upload-delete" href="#">{deleteButtonText}</a>' +
                            '<span class="qq-upload-status-text">{statusText}</span>' +
                            '</li>',
                        classes: {
                            success: 'alert alert-success',
                            fail: 'alert alert-error',
                        },
                        failedUploadTextDisplay: {
                            mode: 'custom',
                            maxChars: 50,
                            responseProperty: 'error',
                            enableTooltip: true
                        },
                        callbacks: {
                            onComplete: function(id, fileName, responseJSON) {
                                if (responseJSON.success) {
                                    location.reload();
                                }
                            }
                        }
                    });
                }
                window.onload = createUploader;
                $(document).ready(function(){
                    $('input[name=radio-sort]').click(function(){
                        var li=$(this).attr('data-item');
                        if(li=='ff-item-type-all'){
                            $('.thumbnails li').fadeTo(500,1);
                            $('.thumbnails li a').show();
                        }else{
                            if($(this).is(':checked')){
                                $('.thumbnails li').not('.'+li).fadeTo(500,0.1);
                                $('.thumbnails li a').not('.'+li+' a').hide();
                                $('.thumbnails li.'+li).fadeTo(500,1);
                                $('.thumbnails li.'+li+' a').show();
                            }
                        }
                    });
                });
                function apply(file){
                    var path = '<? echo $upload_dir; ?>';
                    var track = $('#track').val();
                    var target = window.parent.document.getElementById(track+'_ifr');
                    var closed = window.parent.document.getElementsByClassName('mce-filemanager');
                    var ext_check=file.split('.');
                    var ext = ext_check[1];
                    var ext_img=new Array('jpg','jpeg','png','gif','bmp','tiff');
                    var fill='';
                    if($.inArray(ext, ext_img) > -1){
                        fill=$("<img />",{"src":path+file});
                    }else{
                        fill=$("<a />").attr("href", path+file).text(ext_check[0]);
                    }
                    $(target).contents().find('#tinymce').append(fill);
                    $(closed).find('.mce-close').trigger('click');
                }
                function apply_img(file){
                    var path = '<? echo $upload_dir; ?>';
                    var track = $('#track').val();
                    var target = window.parent.document.getElementsByClassName('mce-img_'+track);
                    var closed = window.parent.document.getElementsByClassName('mce-filemanager');
                    $(target).val(path+file);
                    $(closed).find('.mce-close').trigger('click');
                }
            </script>
            <input type="hidden" id="track" value="<? echo $_GET['editor']; ?>" />
            <div id="bootstrapped-fine-uploader" class="affix"></div>
            <br />
            <div class="container-fluid">
                <div class="row-fluid ff-container">
                    <div class="span2 affix">
                        <input id="select-type-all" name="radio-sort" type="radio" data-item="ff-item-type-all" />
                        <label for="select-type-all" class="btn ff-label-type-all"><? echo lang_All; ?></label>
                        <br />
                        <input id="select-type-1" name="radio-sort" type="radio" data-item="ff-item-type-1" checked="checked" />
                        <label for="select-type-1" class="btn ff-label-type-1"><? echo lang_Files; ?></label>
                        <br />	
                        <input id="select-type-2" name="radio-sort" type="radio" data-item="ff-item-type-2" />
                        <label for="select-type-2" class="btn ff-label-type-2"><? echo lang_Images; ?></label>
                        <br />
                        <input id="select-type-3" name="radio-sort" type="radio" data-item="ff-item-type-3" />
                        <label for="select-type-3" class="btn ff-label-type-3"><? echo lang_Archives; ?></label>
                    </div>
                    <div class="span10 pull-right">
                        <ul class="thumbnails ff-items">
                            <?
                            $ext_img = array('jpg', 'jpeg', 'png', 'gif', 'bmp', 'tiff');
                            $ext_file = array('doc', 'docx', 'pdf', 'xls', 'xlsx', 'txt', 'csv');
                            $ext_misc = array('zip', 'rar');
                            $class_ext = '';
                            $src = '';
                            $dir = opendir($root.$upload_dir);
                            $i = 0;
                            if (isset($_GET['img_only']))
                                $apply = 'apply_img';
                            else
                                $apply = 'apply';
                            while ($file = readdir($dir)) {
                                if ($file != '.' && $file != '..' && !is_dir($root.$upload_dir . $file)) {
                                    $ext = substr($file, -3);
                                    if ($ext == 'peg' || $ext == 'ocx' || $ext == 'lsx')
                                        $ext = substr($file, -4);
                                    if (in_array($ext, $ext_file)) {
                                        $class_ext = 1;
                                        $src = 'img/pdf.gif';
                                    } else if (in_array($ext, $ext_img)) {
                                        $class_ext = 2;
                                        $src = $wwwroot . $upload_dir . $file;
                                    } else if (in_array($ext, $ext_misc)) {
                                        $class_ext = 3;
                                        $src = 'img/compress.gif';
                                    }
                                    if ($i % 4 == 0) {
                                        $ml = 'noml';
                                    } else {
                                        $ml = '';
                                    }
                                    ?>
                                    <li class="span3 ff-item-type-<? echo $class_ext . ' ' . $ml; ?>">
                                        <div class="thumbnail">
                                            <img data-src="holder.js/140x100" alt="140x100" src="<? echo $src; ?>" height="100">
                                                <h4><? echo substr($file, 0, '-' . (strlen($ext) + 1)); ?></h4>
                                                <p class="clearfix"><a href="#" onclick="<? echo $apply; ?>('<? echo $file; ?>')" class="btn btn-mini btn-primary pull-left"><? echo lang_Select; ?></a><a href="dialog.php?del_file=<? echo $file; ?>&editor=<? echo $_GET['editor'] ? $_GET['editor'] : 'mce_0'; ?>&lang=<? echo $_GET['lang'] ? $_GET['lang'] : 'en_EN'; ?>" class="btn btn-mini btn-danger pull-right" onclick="return confirm('<? echo lang_Confirm_del; ?>');"><? echo lang_Erase; ?></a></p>
                                        </div>
                                    </li>
                                    <?
                                    $i++;
                                }
                            }
                            closedir($dir);
                            ?>
                        </ul>
                    </div>
                </div>
            </div>
