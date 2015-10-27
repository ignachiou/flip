<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\Url;
?>
<img src="../web/imagenes/monografias/13/2.jpg" alt="Photograph of a chocolate cupcake.">

s
<table>
 <tr>
<?php
header('Content-type: text/html; charset=utf-8');
# Galer�a de im�genes
# (CC) Alfonso Saavedra "Son Link"
# Bajo GPLv3
 
$path = '../web/imagenes/monografias/13'; # Directorio donde est�n las im�genes
$limit = 4; # Cuantas im�genes se mostraran por pagina
$limit_file = 2; # Im�genes a mostrar por linea en la tabla
$n = 0;
$desde;
$hasta;
# Comprobamos si es un directorio y si lo es nos movemos a el
if (is_dir($path)){
 $dir = opendir($path);
 # Recorremos los ficheros que hay en el directorio y tomamos solamente aquellos cuya extensi�n
 # sea jpg, gif y png y la guardamos en una lista
 while (false !== ($file = readdir($dir))) {
  if (preg_match("#([a-zA-Z0-9_\-\s]+)\.(gif|GIF|jpg|JPG|png|PNG)#is",$file)){
   $list[] = $file;
  }
 }
 # Cerramos el directorio
 closedir($dir);
 # Ordenamos la lista
 sort ($list);
 # Contamos el total de elementos en la lista
 $total = count($list);
 $paginas = ceil($total/$limit);//ceil para aproximar
 if (!isset($_GET['pg'])){
  $desde = 0;
  $hasta = $desde + $limit;
 }else if((int)$_GET['pg'] > ($paginas-1)){
  # Si pg es mayor que el total de paginas se muestra un error
  echo "<b>No existe esta pagina en la galer�a</b>
<a href='galeria.php'>Volver a la galer�a</a>";
  die();
 }else{
  $desde = (int)$_GET['pg'];
 }
 # Y generamos los enlaces con los thumbnails
 for ($i=($desde*$limit);($i!=$total) && ($i<($desde*$limit)+$limit);$i++){
  # Comprobamos si existe en la lista una llave con el valor actual de $i para evitar errores
  if(array_key_exists($i, $list)){
   echo "<td><a href='$path/$list[$i]'><img src='thumb.php?img=$path/$list[$i]' /></a>
</td>\n";
   $n++;
   if ($n == $limit_file){
    echo "</tr>\n<tr>\n";
    $n = 0;
   }
  }
 }
}else{
 echo "$path no es un directorio";
}
?>
 </tr>
</table>
<p id="paginas">
<?php
# Generamos un listado de las paginas de la galer�a
for ($p = 0; $p<$paginas; $p++){
 $pg = $p+1;
 if ($p == $desde){
  echo "pagina $pg ";
 }else{
  echo "<a href ='?pg=$p'>$pg</a> ";
 } 
}?>
</p>
<?php echo "Hay un total de $total imagen(es) en $paginas paginas(s)" ?>

