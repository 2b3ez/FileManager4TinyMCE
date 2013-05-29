*********************************************************
! FileManager for TinyMCE Version 3.0
*********************************************************

FileManager for TinyMCE is a tool make with jQuery library that offers a nice and elegant way to upload and insert files, images and videos with tinyMCE v.4.x

Version 3.0 NEWS:

- You can set (if you want) automatic resizing of uploaded images.
- You can set the permits to delete files, folder and create folder.
- This version support advanced tab on tinymce image plugin
- In files list NOW the plugin create a thumbnail image with low resolution for preview!!!



DEMO: http://test.albertoperipolli.com/filemanager4tinymce/

License: http://opensource.org/licenses/GPL-3.0

Creators : 

info@albertoperipolli.com - tr1pp0

mybeeez@gmail.com - b3ez

*********************************************************
! Installation
*********************************************************

1. Upload each folder plugins (images, link, media and filemanager) to tinymce plugins folder (lang file is optional)
2. open filemanager/config.php
3. set your settings like base_url, upload_dir, type extensions, max file size,... other specifications. 
4. Create the 2 folder for thumbs and file and give write permits.
5. Save and upload config.php
6. Edit all "file:" property in plugins/image/plugin.min.js, plugins/link/plugin.min.js and plugins/media/plugin.min.js  for proper path to dialog.php
7. Settings of tinymce should be like :

 selector: "textarea",
    theme: "modern",
    width: 680,
    height: 300,
    language : 'fr_FR',
    plugins: [
         "advlist autolink link image lists charmap print preview hr anchor pagebreak",
         "searchreplace wordcount visualblocks visualchars code insertdatetime media nonbreaking",
         "table contextmenu directionality emoticons paste textcolor filemanager"
   ],
   image_advtab: true,
   toolbar: "undo redo | bold italic underline | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | styleselect forecolor backcolor | link unlink anchor | image media | print preview code"
 }); 

P.S.: if you have a site with url-rewriting is required to edit both plugin.min.js files and change the relative url after file: to a absolute url from root  "/path/to/file" otherwise. Remember to assign permits to upload dir and thumbs dir. Moreover set the thumbs folder out of base upload folder; the best is to put it in the same level.

Localization: ENG,FRA,ITA,GER[Oliver Beta],POR-BRA[paulomanrique]

*********************************************************
! Credits
*********************************************************

Bootstrap
=> go to site :  http://twitter.github.io/bootstrap/

Bootstrap Lightbox
=> go to site :  http://jbutz.github.io/bootstrap-lightbox/

Dropzonejs
=> go to site :  http://www.dropzonejs.com/

*********************************************************

Enjoy !
