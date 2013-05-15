_________________________________________________________
! FileManager for TinyMCE
_________________________________________________________

FileManager for TinyMCE is a tool make with jQuery library that offers a nice and elegant way to upload and insert file for tinyMCE v.4.x

License: http://opensource.org/licenses/GPL-3.0

Creator : mybeeez@gmail.com - b3ez

          info@albertoperipolli.com - tr1pp0

_________________________________________________________
! Installation
_________________________________________________________

1. Upload each folder plugins (images and file manager) to tinymce plugins folder
(lang file is optionnal)
2. open filemanager/config.php
3. set your settings like upload_dir…
4. Save and upload config.php
5. Edit "file" property in both plugins/image/plugin.min.js and plugins/filemanager/plugin.min.js for proper path to dialog.php
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
   toolbar: "undo redo | bold italic underline | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | styleselect forecolor backcolor | link unlink anchor | filemanager image media | print preview code"
 }); 

P.S.: if you have a site with url-rewriting is required to edit both plugin.min.js files and change the relative url after file: to a absolute url "/path/to/file" otherwise

_________________________________________________________
! Credits
_________________________________________________________

Special Thanks to Alberto Peripolli for his great contribution update

Bootstrap
=> go to site :  http://twitter.github.io/bootstrap/

Bootstrap Lightbox
=> go to site :  http://jbutz.github.io/bootstrap-lightbox/

Dropzonejs
=> go to site :  http://www.dropzonejs.com/
_________________________________________________________
Enjoy !
