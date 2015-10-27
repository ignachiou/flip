<?php
# Generador de Thumbnails para galerías de imágenes
# (CC) Alfonso Saavedra "Son Link"
# Bajo GPLv3
 
# Indicamos al navegador que lo que se envía es una imagen en formato jpg
header( "Content-type: image/jpeg" );
if (!empty($_GET['img'])){
 $new_width  = 150; // Tamaño a definir
  
 $img = $_GET['img'];
 # obtenemos las extensiones de los archivos para llamar a la función correspondiente
 $ext = preg_split('/\./', $img);
 if ($ext[1] == 'JPG' || $ext[1] == 'jpg'){
  $image = ImageCreateFromJPEG($img);
 }else if ($ext[1] == 'gif' || $ext[1] == 'GIF'){
  $image = ImageCreateFromGIF($img);
 }else if ($ext[1] == 'png' || $ext[1] == 'PNG'){
  $image = ImageCreateFromPNG($img);
 }
 # Obtenemos el ancho y el alto de la imagen
 $width  = imagesx($image) ;
 $height = imagesy($image) ;
 # Si el ancho de la imagen es igual o menor del indicado en new_width redirigimos directamente a la imagen
 if ($width < $new_width){
  imagedestroy($image);
  header("location: $img");
 }else{
  # En caso contrario se crea el thumbnail
  $new_height = ($new_width * $height) / $width ; // tamaño proporcional
 
  $thumb = imagecreatetruecolor($new_width,$new_height);
 
  imagecopyresized($thumb,$image,0,0,0,0,$new_width,$new_height,$width,$height);
  #mostramos la imagen generada
  ImageJPEG($thumb);
  # Y liberamos memoria
  imagedestroy($image);
  imagedestroy($thumb);
 }
}
?>