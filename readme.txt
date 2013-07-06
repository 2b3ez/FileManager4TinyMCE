*********************************************************
! FileManager for TinyMCE Version 5.0.0
*********************************************************

FileManager for TinyMCE is a tool make with jQuery library that offers a nice and elegant way to upload and insert files, images and videos with tinyMCE v.4.x.
Now you can use also as normal filemanager, you can manage and select files.
The script automatically create a thumbs of images for preview list.
You can config if you want an automatic resizing of uploaded images.

Version 5.0 NEWS:
- Stand-alone use of filemanager, you can open and select files also dividing them according to the type (video, images and all files)

DEMO: http://test.albertoperipolli.com/filemanager4tinymce/

License: http://opensource.org/licenses/GPL-3.0

Creators : 

info@albertoperipolli.com - tr1pp0

mybeeez@gmail.com - b3ez

*********************************************************
! Installation
*********************************************************

1. Upload each folder plugins (images, link, media and filemanager) to tinymce plugins folder (lang file is optional)
2. open filemanager/config.php and set your configurations like base_url, upload_dir, type extensions allowed , max file size, permits… and other specifications. save file. 
3. create folder where upload files and give write permits.
4. your work is finish!!! settings of tinymce should be like : (remember to add filemanager in plugins list)

 selector: "textarea",
    theme: "modern",
    width: 680,
    height: 300,
    plugins: [
         "advlist autolink link image lists charmap print preview hr anchor pagebreak",
         "searchreplace wordcount visualblocks visualchars code insertdatetime media nonbreaking",
         "table contextmenu directionality emoticons paste textcolor filemanager"
   ],
   image_advtab: true,
   toolbar: "undo redo | bold italic underline | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | styleselect forecolor backcolor | link unlink anchor | image media | print preview code"
 }); 

P.S.: If you not view the preview images remember to set the thumbs folder in plugin/filemanager/thumbs with write permits.


USING AS STAND-ALONE FILEMANAGER

You can use normal popup, bootstrap modal, fancybox iframe , lightbox iframe to open the filemanager with this paths:

Only open filemanager(type=0 and not set field_id): 
path to filemanager../filemanager/dialog.php?type=0&editor=mce_0&lang=eng&fldr=

Select Image: (type=2 and set id of input text in field_id variable): 
path to filemanager../filemanager/dialog.php?type=1&editor=mce_0&lang=eng&fldr=&field_id=fieldID

Select Video: (type=3 and set id of input text in field_id variable): 
path to filemanager../filemanager/dialog.php?type=3&editor=mce_0&lang=eng&fldr=&field_id=fieldID

Select File: (type=2 and set id of input text in field_id variable): 
path to filemanager../filemanager/dialog.php?type=2&editor=mce_0&lang=eng&fldr=&field_id=fieldID

In demo page i use fancybox with this configuration:

    $('.iframe-btn').fancybox({	
	'width'		: 900,
	'height'	: 600,
	'type'		: 'iframe',
        'autoScale'    	: false
    });

and button have this code to open filemanager:

<a href="js/tinymce/plugins/filemanager/dialog.php?type=0&editor=mce_0&lang=eng&fldr=" class="btn iframe-btn" type="button">Open Filemanager</a>


*********************************************************
! Localization
*********************************************************

- CZE[jlusticky]
- ENG
- FRA
- GER[Oliver Beta]
- HUN[Bende Roland]
- ITA
- POL[Michell Hoduń]
- POR-BRA[paulomanrique]
- POR-PT[Sérgio Lima]
- RUS[vasromand]


*********************************************************
! Old version news
*********************************************************

Version 4.0 NEWS:
- Further simplify the installation steps
- Now thumbs folder is inside the file manager script
- Fix resizing bug, create folder possible bug
- AUTOMATIC Realignment of THUMBS tree and images if you upload file from other client FTP or other method
- Add loading animation while the image lightbox loading
- Add possibility to config size width or/and height image limits
- Add possibility to config automatic resizing and set only width or height size
- white background in png thumbs
- fallback upload for old browser
- fix folder delete bug	

Version 3.0 NEWS:

- With this plugin you can also set automatic resizing of uploaded images.
- Moreover you can set the permits to delete files, folder and create folder.
- This version support advanced tab on image plugin
- For preview img in files list the plugin NOW create a thumbnail image with low resolution!!!
- Simplify the installation steps


*********************************************************
! Credits
*********************************************************

Bootstrap => http://twitter.github.io/bootstrap/

Bootstrap Lightbox => http://jbutz.github.io/bootstrap-lightbox/

Dropzonejs => http://www.dropzonejs.com/

*********************************************************

Enjoy !
