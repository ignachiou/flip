<?php
use yii\helpers\Url;
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\data\Pagination;
use yii\widgets\LinkPager;
?>

<?php $f = ActiveForm::begin([
		"method" => "get",
		"action" => Url::toRoute("site/simple"),
		"enableClientValidation" => true,
]);
?>

<div class="form-group">
	<center><?= $f->field($form, "m")->input("buscar")?></center> 
</div>

<center><?= Html::submitButton("Buscar", ["class" => "btn btn-primary"])?></center>

<?php $f->end() ?>

<h3>Lista de objetos bibliograficos</h3>
<table class= " table table-bordered">
	<tr>
	
		<th>Nombre del Objeto Bibliografico</th>
		<th>Autor</th>
		<th>Editorial</th>
		<th>Fecha de Publicacion</th>
				
	</tr>
	<?php foreach ($model as $row): ?>
	<tr>
		<td><a href= "<?= Url::toRoute(["site/prueba", "id_objeto" => $row->id_objeto, "url" => $row->url]) ?>"><?= $row->nombre ?></a></td>
		<td><?= $row->autor?></td>
		<td><?= $row->editorial?></td>
		<td><?= $row->fecha?></td>
				
    </tr>
	<?php endforeach?>
</table>	

<?= LinkPager::widget([
    'pagination' => $pages,
]);
