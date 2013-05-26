*********************************************************
! FileManager for TinyMCE
*********************************************************

FileManager for TinyMCE is a tool make with jQuery library that offers a nice and elegant way to upload and insert files, images and videos with tinyMCE v.4.x

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
3. set your settings like base_url, upload_dir, type extensions, max file size,...
4. Save and upload config.php
5. Edit all "file:" property in plugins/image/plugin.min.js, plugins/link/plugin.min.js and plugins/media/plugin.min.js  for proper path to dialog.php
6. Settings of tinymce should be like :

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
   toolbar: "undo redo | bold italic underline | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | styleselect forecolor backcolor | link unlink anchor | image media | print preview code"
 }); 

P.S.: if you have a site with url-rewriting is required to edit both plugin.min.js files and change the relative url after file: to a absolute url from root  "/path/to/file" otherwise

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
