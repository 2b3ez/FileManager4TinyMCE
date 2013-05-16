
$(document).ready(function(){	
    $('input[name=radio-sort]').click(function(){
        var li=$(this).data('item');
		$('.filters label').removeClass("btn-info");
		$('#'+li).addClass("btn-info");
        if(li=='ff-item-type-all'){ 
			$('.thumbnails li').fadeTo(500,1); 
		}else{
            if($(this).is(':checked')){
                $('.thumbnails li').not('.'+li).fadeTo(500,0.1);
                $('.thumbnails li.'+li).fadeTo(500,1);
            }
        }
    });
	$('.upload-btn').click(function(){
		$('.uploader').show(500);
	});
	$('.close-uploader').click(function(){
		$('.uploader').hide(500);
		window.location.reload();
	});
	$('.preview').click(function(){
		$('#full-img').attr('src',$(this).data('url'));
		return true;
	});
	$('.new-folder').click(function(){
		folder_name=window.prompt($('#insert_folder_name').val(),'Nuova Cartella');
		if(folder_name){
		folder_path=$('#root').val()+$('#cur_dir').val()+ folder_name;
		$.ajax({
			  type: "POST",
			  url: "createfolder.php",
			  data: {path: folder_path}
			}).done(function( msg ) {
			window.location.reload();
		});
		}
	});
	
	var boxes = $('.boxes');
	boxes.height('auto');
	var maxHeight = Math.max.apply(
	  Math, boxes.map(function() {
	    return $(this).height();
	}).get());
	boxes.height(maxHeight);
});

	

function apply(file){
    var path = $('#cur_dir').val();
    var track = $('#track').val();
    var target = window.parent.document.getElementById(track+'_ifr');
    var closed = window.parent.document.getElementsByClassName('mce-filemanager');
    var ext=file.split('.').pop();
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
    var path = $('#cur_dir').val();
    var track = $('#track').val();
    var target = window.parent.document.getElementsByClassName('mce-img_'+track);
    var closed = window.parent.document.getElementsByClassName('mce-filemanager');
    $(target).val(path+file);
    $(closed).find('.mce-close').trigger('click');
}
