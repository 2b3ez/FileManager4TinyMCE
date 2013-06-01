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

	$('#full-img').click(function(){$('#previewLightbox').lightbox('hide'); });
	$('.upload-btn').click(function(){
		$('.uploader').show(500);
	});
	$('.close-uploader').click(function(){
		$('.uploader').hide(500);
		window.location.href = $('#refresh').attr('href');
	});
	$('.preview').click(function(){
		$('#full-img').attr('src',$(this).data('url'));
		if(!$(this).hasClass('disabled'))
			show_animation();
		return true;
	});

	$('.new-folder').click(function(){
		folder_name=window.prompt($('#insert_folder_name').val(),$('#new_folder').val());
		if(folder_name){
		folder_path=$('#root').val()+$('#cur_dir').val()+ folder_name;
		folder_path_thumb=$('#cur_dir_thumb').val()+ folder_name;
		$.ajax({
			  type: "POST",
			  url: "create_folder.php",
			  data: {path: folder_path, path_thumb: folder_path_thumb}
			}).done(function( msg ) {
			window.location.href = $('#refresh').attr('href');
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
	var base_url = $('#base_url').val();
	var track = $('#track').val();
    var target = window.parent.document.getElementById(track+'_ifr');
	var closed = window.parent.document.getElementsByClassName('mce-filemanager');
    var ext=file.split('.').pop();
    var fill='';
    if($.inArray(ext, ext_img) > -1){
    	
        fill=$("<img />",{"src":path+file});
    }else{
        fill=$("<a />").attr("href", path+file).text(file.replace(/\..+$/, ''));
    }
    $(target).contents().find('#tinymce').append(fill);
    $(closed).find('.mce-close').trigger('click');
}

function apply_link(file,type_file){
	var path = $('#cur_dir').val();
	var base_url = $('#base_url').val();
	var track = $('#track').val();
	$('.mce-link_'+track, window.parent.document).val(base_url+path+file);
	var closed = window.parent.document.getElementsByClassName('mce-filemanager');
	if($('.mce-text_'+track, window.parent.document).val()=='') $('.mce-text_'+track, window.parent.document).val(file.replace(/\..+$/, ''));
    $(closed).find('.mce-close').trigger('click');
}

function apply_img(file,type_file){
	var path = $('#cur_dir').val();
	var base_url = $('#base_url').val();
	var track = $('#track').val();
    var target = window.parent.document.getElementsByClassName('mce-img_'+track);
	var closed = window.parent.document.getElementsByClassName('mce-filemanager');
    $(target).val(base_url+path+file);
    $(closed).find('.mce-close').trigger('click');
}

function apply_video(file,type_file){
	var path = $('#cur_dir').val();
	var base_url = $('#base_url').val();
	var track = $('#track').val();
    var target = window.parent.document.getElementsByClassName('mce-video'+ type_file +'_'+track);
	var closed = window.parent.document.getElementsByClassName('mce-filemanager');
    $(target).val(base_url+path+file);
    $(closed).find('.mce-close').trigger('click');
}


function show_animation()
{
	$('#loading_container').css('display', 'block');
	$('#loading').css('opacity', '.7');
}

function hide_animation()
{
	$('#loading_container').fadeOut();
}

	