********************************************************************************
********************************************************************************



NEW VERSION 9!!!!!

NEW version 9 released on http://www.responsivefilemanager.com





********************************************************************************
********************************************************************************
*********************************************************
! FileManager for TinyMCE Version 6.2.0
*********************************************************

FileManager for TinyMCE is a tool make with jQuery library that offers a nice and elegant way to upload and insert files, images and videos with tinyMCE v.4.x.
Now you can use also as normal filemanager, you can manage and select files.
The script automatically create a thumbs of images for preview list.
You can config if you want an automatic resizing of uploaded images.
You can set a subfolder as root and change the configuration for every user, page or filemanager call.


NEWS

Version 6.2.0
- Improve quality of images resizing using PHP Image Magician

Version 6.1.1
- Automatic compatibility with popup by pass the popup GET variable

Version 6.1.0
- Compatibility with Internet Explorer and old browser
- Fix delete bug
- Improve security

Version 6.0.1
- Improve Responsive design

Version 6.0.0
- New amazing flat interface
- Possibility to set subfolder as root
- Ajax files and folders cancellation
- Improve speed, code structure and image size optimization
- If image is smaller than thumbnail the file manager show the image centered  
- TinyMCE link_list now is supported and plugin.min.js files aren't minimized [thanks to Pål Schroeder]
- Fix bug in file selection on subfolder and Other bug fix
- Mobile version with swipe event to show options

DEMO: http://test.albertoperipolli.com/filemanager4tinymce/

Released under MIT license

Creator : info@albertoperipolli.com - tr1pp0
Creator until version 1: mybeeez@gmail.com - b3ez

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
    subfolder:"",
    plugins: [
         "advlist autolink link image lists charmap print preview hr anchor pagebreak",
         "searchreplace wordcount visualblocks visualchars code insertdatetime media nonbreaking",
         "table contextmenu directionality emoticons paste textcolor filemanager"
   ],
   image_advtab: true,
   toolbar: "undo redo | bold italic underline | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | styleselect forecolor backcolor | link unlink anchor | image media | print preview code"
 }); 

P.S.: If you not view the preview images remember to set the thumbs folder in plugin/filemanager/thumbs with write permits.
If you update from previous version delete the contents of thumbs folder.


USING AS STAND-ALONE FILEMANAGER

You can use normal popup, bootstrap modal, fancybox iframe , lightbox iframe to open the filemanager with this paths:

Only open filemanager(type=0 and not set field_id): 
path to filemanager../filemanager/dialog.php?type=0&editor=mce_0&lang=eng&fldr=

Select Image: (type=1 and set id of input text in field_id variable): 
path to filemanager../filemanager/dialog.php?type=1&editor=mce_0&lang=eng&fldr=&field_id=fieldID

Select Video: (type=3 and set id of input text in field_id variable): 
path to filemanager../filemanager/dialog.php?type=3&editor=mce_0&lang=eng&fldr=&field_id=fieldID

Select File: (type=2 and set id of input text in field_id variable): 
path to filemanager../filemanager/dialog.php?type=2&editor=mce_0&lang=eng&fldr=&field_id=fieldID

If you want use popup add in the address &popup=1

In demo page i use fancybox with this configuration:

    $('.iframe-btn').fancybox({	
	'width'		: 900,
	'height'	: 600,
	'type'		: 'iframe',
        'autoScale'    	: false
    });

and button have this code to open filemanager:

<a href="js/tinymce/plugins/filemanager/dialog.php?type=0&editor=mce_0&lang=eng&fldr=" class="btn iframe-btn" type="button">Open Filemanager</a>

Remember to include fancybox file in head section:

<link rel="stylesheet" type="text/css" href="fancybox/jquery.fancybox-1.3.4.css" media="screen" />
<script type="text/javascript" src="fancybox/jquery.fancybox-1.3.4.pack.js"></script>

If you not use fancybox, you must change the function to close the windows after file selection in filemanager/js/include.js:

function close_window() {
    parent.$.fancybox.close();
}



SET SUBFOLDER AS ROOT

You can set subfolder as root an change this parameter in tinymce init or in external-link  through the subfolder variables.
So you can have a root folder for every user or use.
Remember to create subfolder in your source folder before :)

In tinymce editor you must set the variable
    subfolder:"folder",
while in external link you can add in get parameters
    &subfolder=folder

Folder Example:

root
- folder1
  - subfolder1
  - subfolder2
- folder2
  -subfolder3

User1 subfolder=""
View:
folder1
  - subfolder1
  - subfolder2
folder2
  -subfolder3

User 2 subfolder="folder1"
View:
subfolder1
subfolder2


*********************************************************
! Localization
*********************************************************
- BGR [Stanislav Panev]
- BRA [paulomanrique]
- CZE [jlusticky]
- ENG
- FRA
- GER [Oliver Beta]
- HUN [Bende Roland]
- ITA
- NLD [johan12]
- POL [Michell Hoduń]
- POR [Sérgio Lima]
- RUS [vasromand]

*********************************************************
! Old version news
*********************************************************
Version 5:
- Stand-alone use of filemanager, you can open and select files also dividing them according to the type (video, images and all files)

Version 4:
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

Version 3:
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
Fancybox => http://fancybox.net/
TouchSwipe => http://labs.rampinteractive.co.uk/touchSwipe/demos/
PHP Image Magician => http://phpimagemagician.jarrodoberto.com/‎
*********************************************************
