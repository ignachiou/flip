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
	<?= $f->field($form, "q")->input("buscar")?> 
</div>

<?= Html::submitButton("Buscar", ["class" => "btn btn-primary"])?>

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
		<td><?= $row->nombre ?></td>
		<td><?= $row->autor?></td>
		<td><?= $row->editorial?></td>
		<td><?= $row->fecha?></td>
				
    </tr>
	<?php endforeach?>
</table>	

<?= LinkPager::widget([
    'pagination' => $pages,
]);
