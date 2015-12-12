<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\Url;
use app\controllers\SiteController;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use app\assets\AppAsset;
use app\models\Pagina;
use app\models\Objeto;

/* @var $this \yii\web\View */
/* @var $content string */

AppAsset::register($this);

$this->title= "Visualizador de páginas"
?>
<!doctype html>
<!--[if lt IE 7 ]> <html lang="en" class="ie6"> <![endif]-->
<!--[if IE 7 ]>    <html lang="en" class="ie7"> <![endif]-->
<!--[if IE 8 ]>    <html lang="en" class="ie8"> <![endif]-->
<!--[if IE 9 ]>    <html lang="en" class="ie9"> <![endif]-->
<!--[if !IE]><!--> <html lang="en"> <!--<![endif]-->
<head>
<title>Visualizador</title>
<meta name="viewport" content="width = device-width, user-scalable = no" />
<script type="text/javascript" src="js/jquery.min.1.7.js"></script>
<script type="text/javascript" src="js/modernizr.2.5.3.min.js"></script>
<script type="text/javascript" src="js/hash.js"></script>
<script type="text/javascript" src="js/movilpage.js"></script>


</head>
<body onhashchange="changePart()">

<?php 
//Informacion de lasmonografias.
	if(isset($_GET["id_objeto"])){
		$id = Html::encode($_GET["id_objeto"]);  #Variable que obtengo a traves de un GET, me pasa el id del objeto a consultar
		$ejemplo = Pagina::find()
			->where(['dependencia' => $id])
			->all();
	}
	if(isset($_GET["url"])){
		$dire = html::encode($_GET["url"]);  #Varible que obtengo a traves de un GET, me pasa la URL de las imagenes almacenadas
	}
	if(isset($_GET["nombre"])){
		$nombre = html::encode($_GET["nombre"]);
	}
	if(isset($_GET["editorial"])){
		$editorial = html::encode($_GET["editorial"]);
	}
	if(isset($_GET["autor"])){
		$autor = html::encode($_GET["autor"]);
	}
	if(isset($_GET["isbn"])){
		$isbn = html::encode($_GET["isbn"]);
	}

//información de las tesis
	if(isset($_GET["id_tesis"])){
		$id = Html::encode($_GET["id_tesis"]);  #Variable que obtengo a traves de un GET, me pasa el id del objeto a consultar
		$ejemplo = Pagina::find()
		->where(['tesis' => $id])
		->all();
	}
	if(isset($_GET["url"])){
		$dire = html::encode($_GET["url"]);  #Varible que obtengo a traves de un GET, me pasa la URL de las imagenes almacenadas
	}
	if(isset($_GET["titulo_tesis"])){
		$titulo_tesis = html::encode($_GET["titulo_tesis"]);
	}
	if(isset($_GET["redactor"])){
		$redactor = html::encode($_GET["redactor"]);
	}
	if(isset($_GET["tutor"])){
		$tutor = html::encode($_GET["tutor"]);
	}
	if(isset($_GET["universidad"])){
		$universidad = html::encode($_GET["universidad"]);
	}
	if(isset($_GET["fecha_tesis"])){
		$fecha = html::encode($_GET["fecha_tesis"]);
	}



//Informacion de las Revistas
	if(isset($_GET["id_revista"])){
		$id = Html::encode($_GET["id_revista"]);  #Variable que obtengo a traves de un GET, me pasa el id del objeto a consultar
		$ejemplo = Pagina::find()
		->where(['publicaciones' => $id])
		->all();
	}	
	if(isset($_GET["url_revista"])){
		$dire = html::encode($_GET["url_revista"]);  #Varible que obtengo a traves de un GET, me pasa la URL de las imagenes almacenadas
	}
	if(isset($_GET["titulo_revista"])){
		$titulo_revista = html::encode($_GET["titulo_revista"]);
	}
	if(isset($_GET["editorial_revista"])){
		$editorial_revista = html::encode($_GET["editorial_revista"]);
	}
	if(isset($_GET["fecha"])){
		$fecha = html::encode($_GET["fecha"]);
	}
	if(isset($_GET["issn"])){
		$issn = html::encode($_GET["issn"]);
	}
	if(isset($_GET["periodicidad"])){
		$periodicidad = html::encode($_GET["periodicidad"]);
	}

//Informacion de los articulos

	if(isset($_GET["id"])){
		$id = Html::encode($_GET["id"]);  #Variable que obtengo a traves de un GET, me pasa el id del objeto a consultar
		$ejemplo = Pagina::find()
		->where(['publicaciones' => $id])
		->all();
	}
	
	if(isset($_GET["tituloar"])){
		$tituloar = html::encode($_GET["tituloar"]);
	}
	if(isset($_GET["autor_articulo"])){
		$autor_articulo = html::encode($_GET["autor_articulo"]);
	}
?>

<?php
header('Content-type: text/html; charset=utf-8');
if(isset($_GET["url"])){ 
	$path = $dire.$id."/"; # Directorio donde están las imágenes
}
if(isset($_GET["url_revista"])){
	$path = $dire;
}
$total = null;
//*******************************************************************
//se almacena la informacion extraida a traves de un query sobre las paginas
foreach ($ejemplo as $i => $ejm)
{
	$descripcion[] = $ejm->descripcion ;
	$direccion[] = $ejm->url;
		
}

//****************************************************************************
# Comprobamos si es un directorio y si lo es nos movemos a él
if (is_dir($path)){
	$dir = opendir($path);
	
	# Recorremos los ficheros que hay en el directorio y tomamos solamente aquellos cuya extensión
	# sea jpg, gif y png y la guardamos en una lista
	while (false !== ($file = readdir($dir))) {
		if (preg_match("#([a-zA-Z0-9_\-\s]+)\.(gif|GIF|jpg|JPG|png|PNG)#is",$file)){
			$list[] = $file;		
		}
	}
	# Cerramos el directorio
	closedir($dir);
	# Ordenamos la lista
	$orden = sort ($list,1);
	#contamos la cantidad de imagenes que existen en el array
	$total = count($list);
	
	for($i=0; $i<$total; $i++){
		
		$check[$i] = strstr($direccion[$i], '.', true); // se abstrae la cadena que esta antes del .jpg
		
		
		}
	}else{
		echo "$path no es un directorio";	
		
	}
	?>
	

<div id="canvas" >

	<div id="containerNegro">

  		<div id="containerBiblio">
  			<div id="titlePageBiblio" >
				<font color="white">Información Bibliográfica</font>
			</div>
			<?php if(isset($nombre)? $nombre:null)
		{		
		?>
  			<b>Nombre:</b><br>
  			<?php echo $nombre; ?><br>
  			<?php }?>
  			<?php if(isset($autor)? $autor:null)
		{		
		?>
  			<b>Autor:</b><br>
  			<?php echo $autor; ?><br>
  			<?php }?>
  			<?php if(isset($editorial)? $editorial:null)
		{		
		?>
  			<b>Editorial:</b><br>
  			<?php echo $editorial;?><br>
  			<?php }?>
  			<?php if(isset($isbn)? $isbn:null)
		{		
		?>
  			<b>Isnb:</b><br>
  			<?php echo $isbn;?>
  			<?php }?>
  			
  			
  			
  		<?php if(isset($titulo_tesis)? $titulo_tesis:null)
		{		
		?>
		 <b> Titulo:</b><br> <?php echo $titulo_tesis;?><br>
		 <?php }?>
		  <?php if(isset($redactor)? $redactor:null)
		{		
		?>
 		 <b> Redactor:</b><br> <?php echo $redactor;?><br>
 		 <?php }?>
 		 <?php if(isset($tutor)? $tutor:null)
		{		
		?>
  		 <b> Tutor:</b><br><?php echo $tutor;?><br>
  		 <?php }?>
  		 <?php if(isset($universidad)? $universidad:null)
		{		
		?>
  		 <b> Universidad:</b><br> <?php echo $universidad;?><br>
  		 <?php }?>
  		 <?php if(isset($fecha_tesis)? $fecha_tesis:null)
		{		
		?>
  		 <b> Fecha:</b><br> <?php echo $fecha_tesis;?>
  		 <?php }?>
  		 
  		 
  			
  	<?php if(isset($titulo_revista)? $titulo_revista:null)
		{		
		?>
		<b> Nombre:</b><br> <?php echo $titulo_revista;?><br>
	<?php }?>
	
	<?php if(isset($editorial_revista)? $editorial_revista:null)
	{	
	?>
		<b> Editorial:</b><br> <?php echo $editorial_revista;?><br>
	<?php }?>
	
	<?php if(isset($fecha)? $fecha:null)
	{
		?>
		<b> Fecha:</b><br> <?php echo $fecha;?><br>
	<?php }?>
	
	<?php if(isset($issn)? $issn:null)
	{
		?>	
		<b> Issn:</b><br> <?php echo $issn;?><br>
	<?php }?>
	
	<?php if(isset($periodicidad)? $periodicidad:null)
	{
		?>	
		<b> Periodicidad:</b><br> <?php echo $periodicidad;?>
  	<?php }?>
  	
	
	
	<?php if(isset($tituloar)? $tituloar:null)
		{		
		?>
		<b> Nombre del Articulo:</b><br> <?php echo $tituloar;?><br>
	<?php }?>
	
	<?php if(isset($autor_articulo)? $autor_articulo:null)
		{		
		?>
		<b> Autor:</b><br> <?php echo $autor_articulo;?><br>
	<?php }?>
	
	
  		</div>
  
  		<div id="contenedorPages">
			<div id="titlePageBox">
				<div id="titlePagePaginas" style="background-color:#2E2E2E; height: 30px;">
					<font color="white">Páginas</font>
				</div>
			
				<div id="pageListDiv">
					<table cellpadding="1" id="pageListTable" cellspacing="0" border="0" width="100%">
						<tbody>
							<?php 
								for($i=0; $i<$total; $i++)
								{							
							?>
							<tr>						
								<td style="width: 200px; cursor: pointer"; bgcolor="#ffffff" onmouseover="this.style.cursor='pointer';" >
									<b><a id="pageSelect" href="#<?php echo $check[$i]?>"> <?php echo $descripcion[$i];?></a></b>
								</td>
														
							</tr>	
							<?php 
								}
							?>	
						</tbody>					
					</table>			
				</div>
		
		</div>
		<?php if (!Yii::$app->user->isGuest) {
          	#Contenido visible únicamente para usuarios logeados
    	 ?>	
		<div id="linking"> 
			Descargar Página: <br>
			<a href="sdf"; download=""; onclick="changePart();" id="link" style="position: absolute; bottom:-20px; left:5px;" ></a>
	
		</div>
		<?php  } else {
         	 # Contenido para el resto de visitas (o usuarios no conectados)
      	} 
		?>
  		</div>
	</div>

	<font color="white">sdfsd</font>
	<div class="zoom-icon zoom-icon-in"></div>

	<div class="magazine-viewport"  >

		<div class="container" >
			<font color="black">SSalvatierra</font>
			<div class="magazine" >
				<!-- Next button -->
				<div ignore="1" class="next-button"></div>
				<!-- Previous button -->
				<div ignore="1" class="previous-button"></div>
			</div>
		</div>	
	</div>
</div>



<script>
	var newDire;
    function changePart() {    	//usamos el location.hash para registrar cambios es los anclas hash y las imprimimos.
    	var x = location.hash.substring(1);
    	var newDire = document.getElementById("link").innerHTML =  x + ".jpg"; //almaceno la direccion donde se encuentra la imagen.
   		document.getElementById("link").download = newDire ; //descarga la imagen directamente al presionar el ancher.
   		document.getElementById("link").href = newDire;		//esto me crea el link a la imagen para proceder a descargarla.
    	document.getElementById("link").innerHTML =  x;
}

</script>


<script type="text/javascript">
														

function addPage(page, book) {

	var id, pages = book.turn('pages');

	// Crear un nuevo elemento para la pagina
	var element = $('<div />', {});

	// Agregar la pagina al flip
	if (book.turn('addPage', element, page)) {

		
		element.html('<div class="gradient"></div><div class="loader"></div>');

		// Cargar la Pagina
		loadPage(page, element);
	}

}





function loadPage(page, pageElement) {

	// crea el elemento imagen

	var img = $('<img />');

	img.mousedown(function(e) {
		e.preventDefault();
	});

	img.load(function() {
		
		// colocamos el tamaño de la imagen
		$(this).css({width: '100%', height: '100%'});

		// Add the image to the page after loaded

		$(this).appendTo(pageElement);

		// removemos el indicador de carga
		
		pageElement.find('.loader').remove();
	});

	// cargamos la pagina

	img.attr('src', '<?php  echo $path?>' +  page + '.jpg');

	loadRegions(page, pageElement);

}


// Zoom in / Zoom out

function zoomTo(event) {

		setTimeout(function() {
			if ($('.magazine-viewport').data().regionClicked) {
				$('.magazine-viewport').data().regionClicked = false;
			} else {
				if ($('.magazine-viewport').zoom('value')==1) {
					$('.magazine-viewport').zoom('zoomIn', event);
				} else {
					$('.magazine-viewport').zoom('zoomOut');
				}
			}
		}, 1);

}

// cargamos las regiones

function loadRegions(page, element) {

	$.getJSON('<?php  echo $path?>'+page+'-regions.json').
		done(function(data) {

			$.each(data, function(key, region) {
				addRegion(region, element);
			});
		});
}

// agregamos las regiones

function addRegion(region, pageElement) {
	
	var reg = $('<div />', {'class': 'region  ' + region['class']}),
		options = $('.magazine').turn('options'),
		pageWidth = options.width/2,
		pageHeight = options.height;

	reg.css({
		top: Math.round(region.y/pageHeight*100)+'%',
		left: Math.round(region.x/pageWidth*100)+'%',
		width: Math.round(region.width/pageWidth*100)+'%',
		height: Math.round(region.height/pageHeight*100)+'%'
	}).attr('region-data', $.param(region.data||''));


	reg.appendTo(pageElement);
}

// procesamos el click sobre las regiones

function regionClick(event) {

	var region = $(event.target);

	if (region.hasClass('region')) {

		$('.magazine-viewport').data().regionClicked = true;
		
		setTimeout(function() {
			$('.magazine-viewport').data().regionClicked = false;
		}, 100);
		
		var regionType = $.trim(region.attr('class').replace('region', ''));

		return processRegion(region, regionType);

	}

}

// procesamos la información de las regiones

function processRegion(region, regionType) {

	data = decodeParams(region.attr('region-data'));

	switch (regionType) {
		case 'link' :

			window.open(data.url);

		break;
		case 'zoom' :

			var regionOffset = region.offset(),
				viewportOffset = $('.magazine-viewport').offset(),
				pos = {
					x: regionOffset.left-viewportOffset.left,
					y: regionOffset.top-viewportOffset.top
				};

			$('.magazine-viewport').zoom('zoomIn', pos);

		break;
		case 'to-page' :

			$('.magazine').turn('page', data.page);

		break;
	}

}

// cargamos paginas largas

function loadLargePage(page, pageElement) {
	
	var img = $('<img />');

	img.load(function() {

		var prevImg = pageElement.find('img');
		$(this).css({width: '100%', height: '100%'});
		$(this).appendTo(pageElement);
		prevImg.remove();
		
	});

	// carga la nueva pagina
	
	img.attr('src', '<?php  echo $path?>' +  page + '.jpg');
}

// cargamos paginas pequeñas

function loadSmallPage(page, pageElement) {
	
	var img = pageElement.find('img');

	img.css({width: '100%', height: '100%'});

	img.unbind('load');
	// cargamos nueva página

	img.attr('src', '<?php  echo $path?>' +  page + '.jpg');
}

// http://code.google.com/p/chromium/issues/detail?id=128488

function isChrome() {

	return navigator.userAgent.indexOf('Chrome')!=-1;

}

function disableControls(page) {
		if (page==1)
			$('.previous-button').hide();
		else
			$('.previous-button').show();
					
		if (page==$('.magazine').turn('pages'))
			$('.next-button').hide();
		else
			$('.next-button').show();
}

// se coloca el ancho y alto del viewport

function resizeViewport() {

	var width = $(window).width(),
		height = $(window).height(),
		options = $('.magazine').turn('options');

	$('.magazine').removeClass('animated');

	$('.magazine-viewport').css({
		width: width,
		height: height
	}).
	zoom('resize');


	if ($('.magazine').turn('zoom')==1) {
		var bound = calculateBound({
			width: options.width,
			height: options.height,
			boundWidth: Math.min(options.width, width),
			boundHeight: Math.min(options.height, height)
		});

		if (bound.width%2!==0)
			bound.width-=1;

			
		if (bound.width!=$('.magazine').width() || bound.height!=$('.magazine').height()) {

			$('.magazine').turn('size', bound.width, bound.height);

			if ($('.magazine').turn('page')==1)
				$('.magazine').turn('peel', 'br');

			$('.next-button').css({height: bound.height, backgroundPosition: '-38px '+(bound.height/2-32/2)+'px'});
			$('.previous-button').css({height: bound.height, backgroundPosition: '-4px '+(bound.height/2-32/2)+'px'});
		}

		$('.magazine').css({top: -bound.height/2, left: -bound.width/2});
	}

	var magazineOffset = $('.magazine').offset(),
		boundH = height - magazineOffset.top - $('.magazine').height(),
		marginTop = (boundH - $('.thumbnails > div').height()) / 2;

	if (marginTop<0) {
		$('.thumbnails').css({height:1});
	} else {
		$('.thumbnails').css({height: boundH});
		$('.thumbnails > div').css({marginTop: marginTop});
	}

	if (magazineOffset.top<$('.made').height())
		$('.made').hide();
	else
		$('.made').show();

	$('.magazine').addClass('animated');
	
}


// cantidad de vistas en el flip

function numberOfViews(book) {
	return book.turn('pages') / 2 + 1;
}

// vista actual

function getViewNumber(book, page) {
	return parseInt((page || book.turn('page'))/2 + 1, 10);
}

function moveBar(yes) {
	if (Modernizr && Modernizr.csstransforms) {
		$('#slider .ui-slider-handle').css({zIndex: yes ? -1 : 10000});
	}
}

function setPreview(view) {

	var previewWidth = 112,
		previewHeight = 73,
		previewSrc = 'pages/preview.jpg',
		preview = $(_thumbPreview.children(':first')),
		numPages = (view==1 || view==$('#slider').slider('option', 'max')) ? 1 : 2,
		width = (numPages==1) ? previewWidth/2 : previewWidth;

	_thumbPreview.
		addClass('no-transition').
		css({width: width + 15,
			height: previewHeight + 15,
			top: -previewHeight - 30,
			left: ($($('#slider').children(':first')).width() - width - 15)/2
		});

	preview.css({
		width: width,
		height: previewHeight
	});

	if (preview.css('background-image')==='' ||
		preview.css('background-image')=='none') {

		preview.css({backgroundImage: 'url(' + previewSrc + ')'});

		setTimeout(function(){
			_thumbPreview.removeClass('no-transition');
		}, 0);

	}

	preview.css({backgroundPosition:
		'0px -'+((view-1)*previewHeight)+'px'
	});
}

// profundidad del zoom in

function largeMagazineWidth() {
	
	return 1900;

}

// parametros URL

function decodeParams(data) {

	var parts = data.split('&'), d, obj = {};

	for (var i =0; i<parts.length; i++) {
		d = parts[i].split('=');
		obj[decodeURIComponent(d[0])] = decodeURIComponent(d[1]);
	}

	return obj;
}

// calculamos el ancho y largo de cada bloque

function calculateBound(d) {
	
	var bound = {width: d.width, height: d.height};

	if (bound.width>d.boundWidth || bound.height>d.boundHeight) {
		
		var rel = bound.width/bound.height;

		if (d.boundWidth/rel>d.boundHeight && d.boundHeight*rel<=d.boundWidth) {
			
			bound.width = Math.round(d.boundHeight*rel);
			bound.height = d.boundHeight;

		} else {
			
			bound.width = d.boundWidth;
			bound.height = Math.round(d.boundWidth/rel);
		
		}
	}
		
	return bound;
}


function loadApp() {

 	$('#canvas').fadeIn(1000);

 	var flipbook = $('.magazine');

 	// verificamos que el css haya sido cargado
	
	if (flipbook.width()==0 || flipbook.height()==0) {
		setTimeout(loadApp, 10);
		return;
	}
	
	// creamos el flip

	flipbook.turn({
			
			// ancho del flip

			width: 922,

			// altura del flipt

			height: 600,

			// msegundos que dura en cambiar la pagina 

			duration: 1000,

			// para uso fuera de chrome

			acceleration: !isChrome(),

			// habilita el gradiente

			gradients: true,
			
			// centra solo el flip

			autoCenter: true,

			// elavacion de cada esquina del flip

			elevation: 50,

			// numero de paginas del flip

			pages: <?php echo $total?>,

		
			// eventos:

			when: {
				turning: function(event, page, view) {
					
					var book = $(this),
					currentPage = book.turn('page'),
					pages = book.turn('pages');
			
					// Actualizar la URI

					Hash.go('<?php  echo $path?>' + page ).update();

					// Mostrar o esconder los botones de navegacion

					disableControls(page);
					

					$('.thumbnails .page-'+currentPage).
						parent().
						removeClass('current');

					$('.thumbnails .page-'+page).
						parent().
						addClass('current');



				},

				turned: function(event, page, view) {

					disableControls(page);

					$(this).turn('center');

					if (page==1) { 
						$(this).turn('peel', 'br');
					}

				},

				missing: function (event, pages) {

					// agregar paginas que no estan en el flip si asi es

					for (var i = 0; i < pages.length; i++)
						addPage(pages[i], $(this));

				}
			}

	});



	// Zoom.js

	$('.magazine-viewport').zoom({
		flipbook: $('.magazine'),

		max: function() { 
			
			return largeMagazineWidth()/$('.magazine').width();

		}, 

		when: {

			swipeLeft: function() {

				$(this).zoom('flipbook').turn('next');

			},

			swipeRight: function() {
				
				$(this).zoom('flipbook').turn('previous');

			},

			resize: function(event, scale, page, pageElement) {

				if (scale==1)
					loadSmallPage(page, pageElement);
				else
					loadLargePage(page, pageElement);

			},

			zoomIn: function () {

				$('.thumbnails').hide();
				$('.made').hide();
				$('.magazine').removeClass('animated').addClass('zoom-in');
				$('.zoom-icon').removeClass('zoom-icon-in').addClass('zoom-icon-out');
				
				if (!window.escTip && !$.isTouch) {
					escTip = true;

					$('<div />', {'class': 'exit-message'}).
						html('<div>Preciona ESC para alejar</div>').
							appendTo($('body')).
							delay(2000).
							animate({opacity:0}, 500, function() {
								$(this).remove();
							});
				}
			},

			zoomOut: function () {

				$('.exit-message').hide();
				$('.thumbnails').fadeIn();
				$('.made').fadeIn();
				$('.zoom-icon').removeClass('zoom-icon-out').addClass('zoom-icon-in');

				setTimeout(function(){
					$('.magazine').addClass('animated').removeClass('zoom-in');
					resizeViewport();
				}, 0);

			}
		}
	});

	// evento del zoom

	if ($.isTouch)
		$('.magazine-viewport').bind('zoom.doubleTap', zoomTo);
	else
		$('.magazine-viewport').bind('zoom.tap', zoomTo);


	// configuracion de las teclas para el cambio de paginas

	$(document).keydown(function(e){

		var previous = 37, next = 39, esc = 27;

		switch (e.keyCode) {
			case previous:

				// flecha izquierda
				$('.magazine').turn('previous');
				e.preventDefault();

			break;
			case next:

				//flecha derecha
				$('.magazine').turn('next');
				e.preventDefault();

			break;
			case esc:
				
				$('.magazine-viewport').zoom('zoomOut');	
				e.preventDefault();

			break;
		}
	});

	// URIs - Formato #$path/1 

	Hash.on('<?php  echo $path?>([a-zA-Z0-9]*)$', {
		yep: function(path, parts) {
			var page = parts[1];

			if (page!==undefined) {
				if ($('.magazine').turn('is'))
					$('.magazine').turn('page', page);
			}

		},
		nop: function(path) {

			if ($('.magazine').turn('is'))
				$('.magazine').turn('page', 1);
		}
	});


	$(window).resize(function() {
		resizeViewport();
	}).bind('orientationchange', function() {
		resizeViewport();
	});


	// Regiones

	if ($.isTouch) {
		$('.magazine').bind('touchstart', regionClick);
	} else {
		$('.magazine').click(regionClick);
	}

	// Evento de boton lateral

	$('.next-button').bind($.mouseEvents.over, function() {
		
		$(this).addClass('next-button-hover');

	}).bind($.mouseEvents.out, function() {
		
		$(this).removeClass('next-button-hover');

	}).bind($.mouseEvents.down, function() {
		
		$(this).addClass('next-button-down');

	}).bind($.mouseEvents.up, function() {
		
		$(this).removeClass('next-button-down');

	}).click(function() {
		
		$('.magazine').turn('next');

	});

	// Events for the next button
	
	$('.previous-button').bind($.mouseEvents.over, function() {
		
		$(this).addClass('previous-button-hover');

	}).bind($.mouseEvents.out, function() {
		
		$(this).removeClass('previous-button-hover');

	}).bind($.mouseEvents.down, function() {
		
		$(this).addClass('previous-button-down');

	}).bind($.mouseEvents.up, function() {
		
		$(this).removeClass('previous-button-down');

	}).click(function() {
		
		$('.magazine').turn('previous');

	});


	resizeViewport();

	$('.magazine').addClass('animated');

}

// Load the HTML4 version if there's not CSS transform

yepnope({
	test : Modernizr.csstransforms,
	yep: ['js/turn.js'],
	nope: ['js/turn.html4.min.js'],
	both: ['js/zoom.min.js', 'js/magazine.js', 'css/magazine.css'],
	complete: loadApp
});

</script>

</body>
</html>