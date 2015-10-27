<!doctype html>
<!--[if lt IE 7 ]> <html lang="es" class="ie6"> <![endif]-->
<!--[if IE 7 ]>    <html lang="es" class="ie7"> <![endif]-->
<!--[if IE 8 ]>    <html lang="es" class="ie8"> <![endif]-->
<!--[if IE 9 ]>    <html lang="es" class="ie9"> <![endif]-->
<!--[if !IE]><!--> <html lang="es"> <!--<![endif]-->
<head>

<meta http-equiv="Content-Type"  name="viewport" content="text/html, charset=utf-8, width = device-width,  height=device-height, user-scalable = yes" />
<script type="text/javascript" src="../../extras/jquery.min.1.7.js"></script>
<script type="text/javascript" src="../../extras/modernizr.2.5.3.min.js"></script>
</head>
<body>

<?php
header('Content-type: text/html; charset=utf-8');
 
$path = 'pages/'; # Directorio donde están las imágenes

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
	#almacenamos la cantidad de imagenes que existen	
	$total = count($list);
	
	echo "<font color='#ff0000'>soy el &ntilde;</font>";	
	
	}else{
		echo "$path no es un directorio";
	}
	?>

<div class="flipbook-viewport">
	<div class="container">
		<div class="flipbook">
			<?php  						#realizamos un for para rellenar el flipbook
			for($i=0; $i<$total; $i++){
				?>
			
			<div style="background-image:url(<?php echo $path.$list[$i];?>)"></div>
			<?php  } ?>
		</div>
	</div>
</div>


<script type="text/javascript">

function loadApp() {

	// Create the flipbook

	$('.flipbook').turn({
			// Width

			width:922,
			
			// Height

			height:600,

			// Elevation

			elevation: 50,
			
			// Enable gradients

			gradients: true,
			
			// Auto center this flipbook

			autoCenter: true

	});
}

// Load the HTML4 version if there's not CSS transform

yepnope({
	test : Modernizr.csstransforms,
	yep: ['../../lib/turn.js'],
	nope: ['../../lib/turn.html4.min.js'],
	both: ['css/basic.css'],
	complete: loadApp
});

</script>

</body>
</html>