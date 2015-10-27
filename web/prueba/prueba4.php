<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\Url;
?>

<?php
header('Content-type: text/html; charset=utf-8');
# Galería de imágenes
# (CC) Alfonso Saavedra "Son Link"
# Bajo GPLv3
 
$path = '../imagenes/monografias/13'; # Directorio donde están las imágenes

# Comprobamos si es un directorio y si lo es nos movemos a el
if (is_dir($path)){
	$dir = opendir($path);
	
	# Recorremos los ficheros que hay en el directorio y tomamos solamente aquellos cuya extensión
	# sea jpg, gif y png y la guardamos en una lista
	while (false !== ($file = readdir($dir))) {
		if (preg_match("#([a-zA-Z0-9_\-\s]+)\.(gif|GIF|jpg|JPG|png|PNG)#is",$file)){
			$list[] = $file;
			#echo '<img src="'.$path."/".$file.'">.<br />'; //para mostrar las imagenes insertadas
			
		}
	}
	
	# Cerramos el directorio
	closedir($dir);
	# Ordenamos la lista
	$orden = sort ($list,1);
	
	
	
	/*foreach($list as $v){			#imprime cuantas veces hallan en $list donde $list en este caso en igual a 3
		echo '<img src="'.$path."/".$list[0].'">';
	}*/
	
	$total = count($list);
	
	for($i=0; $i<$total; $i++){
		echo '<img src="'.$path."/".$list[$i].'"><br>';
	}
	
	echo $total;
	
	}else{
		echo "$path no es un directorio";
	}
	?>