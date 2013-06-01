<?php 

function create_img_gd($imgfile, $imgthumb, $newwidth, $newheight="") {
    if($newheight=="")
        $newheight=$newwidth;
	//$imgfile=str_replace(" ","%20",$imgfile);
  if (function_exists("imagecreate")) {
    $imginfo = getimagesize($imgfile);

    switch($imginfo[2]) {
      case 1:
          $type = IMG_GIF;
          break;
      case 2:
          $type = IMG_JPG;
          break;
      case 3:
          $type = IMG_PNG;
          break;
      case 4:
          $type = IMG_WBMP;
          break;
      default:
          return $imgfile;
          break;
    }

    switch($type) {
      case IMG_GIF:
          if (!function_exists("imagecreatefromgif")) return $imgfile;
          $srcImage = imagecreatefromgif("$imgfile");
          break;
      case IMG_JPG:
          if (!function_exists("imagecreatefromjpeg")) return $imgfile;
          $srcImage = imagecreatefromjpeg($imgfile);
          break;
      case IMG_PNG:
          if(!function_exists("imagecreatefrompng")) return $imgfile;
          $srcImage = imagecreatefrompng("$imgfile");
          break;
      case IMG_WBMP:
          if (!function_exists("imagecreatefromwbmp")) return $imgfile;
          $srcImage = imagecreatefromwbmp("$imgfile");
          break;
      default:
          return $imgfile;
    }
    $srcWidth = $imginfo[0];
    $srcHeight = $imginfo[1];
			
    if ($srcImage){
        $x=0;
        $y=0;
		$altezza=(int)($srcWidth * $newheight / $newwidth);
		if( $altezza <= $srcHeight){
			$fotoWidth=$srcWidth;
			$fotoHeight=$altezza;
			$y=(int)(($srcHeight - $altezza)/2);
		}else{
			$larghezza =(int)($srcHeight * $newwidth / $newheight);
			$fotoWidth=$larghezza;
			$fotoHeight=$srcHeight;
			$x=(int)(($srcWidth - $larghezza)/2);

		}
      $ratioWidth = $srcWidth / $newwidth;
      $destWidth = $newwidth;
      $destHeight = $newheight;
      $destImage = imagecreatetruecolor($destWidth, $destHeight);
      imagealphablending($destImage, true);
      imagealphablending($srcImage, false);
      imagecopyresized($destImage, $srcImage, 0, 0, $x, $y, $destWidth, $destHeight, $fotoWidth, $fotoHeight);

      switch($type) {
        case IMG_GIF:
            imagegif($destImage, "$imgthumb");
            break;
        case IMG_JPG:
            imagejpeg($destImage, "$imgthumb");
            break;
        case IMG_PNG:
            imagepng($destImage, "$imgthumb");
            break;
        case IMG_WBMP:
            imagewbmp($destImage, "$imgthumb");
            break;
      }

      imagedestroy($srcImage);
      imagedestroy($destImage);
      return $imgthumb;
    } else {return $imgfile;}
  } else {return $imgfile;}
}

function makeSize($size) {
   $units = array('B','KB','MB','GB','TB');
   $u = 0;
   while ( (round($size / 1024) > 0) && ($u < 4) ) {
     $size = $size / 1024;
     $u++;
   }
   return (number_format($size, 1, ',', '') . " " . $units[$u]);
}

function create_folder($path=false,$path_thumbs=false){
	$oldumask = umask(0); 
	if ($path && !file_exists($path))
		mkdir($path, 0777); // or even 01777 so you get the sticky bit set 
	if($path_thumbs && !file_exists($path_thumbs)) 
		mkdir($path_thumbs, 0777); // or even 01777 so you get the sticky bit set 
	umask($oldumask);
}

?>