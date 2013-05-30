*********************************************************
! FileManager for TinyMCE Version 3.0
*********************************************************

FileManager for TinyMCE is a tool make with jQuery library that offers a nice and elegant way to upload and insert files, images and videos with tinyMCE v.4.x

Version 3.0 NEWS:

- With this plugin you can also set automatic resizing of uploaded images.
- Moreover you can set the permits to delete files, folder and create folder.
- This version support advanced tab on image plugin
- For preview img in files list the plugin NOW create a thumbnail image with low resolution!!!
- Simplify the installation steps


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
3. set your configurations like base_url, upload_dir, thumbs_dir, type extensions allowed , max file size, permits… and other specifications. save file. 
4. create 2 folder for thumbs and file and give write permits.
5. your work is finish!!! settings of tinymce should be like : (remember to add filemanager in plugins list)

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

P.S.: Remember to set the thumbs folder out of base upload folder; the best is to put it in the same level.

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
