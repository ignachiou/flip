<?php
use yii\helpers\Url;
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\data\Pagination;
use yii\widgets\LinkPager;
?>

<?php $f = ActiveForm::begin([
		"method" => "get",
		"action" => Url::toRoute("site/publicaciones"),
		"enableClientValidation" => true,
]);
?>

<div class="form-group">
	<center><?= $f->field($form, "p")->input("buscar")?></center> 
</div>

<center><?= Html::submitButton("Buscar", ["class" => "btn btn-primary"])?></center>

<?php $f->end() ?>

<h3>Lista de Publicaciones</h3>
<table class= " table table-bordered">
	<tr>
	
		<th>Nombre de la Revista</th>
		<th>Editorial Revista</th>
		<th>Issn Revista</th>
		<th>Fecha de la Revista</th>
				
	</tr>
	<?php foreach ($model as $row): ?>
	<tr>
		<td><a href= "<?= Url::toRoute(["site/prueba2", "id" => $row->id, "url_revista" => $row->url_revista]) ?>"><?= $row->titulo_revista ?></td>
		<td><?= $row->editorial_revista?></td>
		<td><?= $row->issn_revista?></td>
		<td><?= $row->fecha_revista?></td>
				
    </tr>
	<?php endforeach?>
</table>	

<?= LinkPager::widget([
    'pagination' => $pages,
]);
