<?php
use yii\helpers\Url;
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\data\Pagination;
use yii\widgets\LinkPager;
?>

<?php $f = ActiveForm::begin([
		"method" => "get",
		"action" => Url::toRoute("site/tesis"),
		"enableClientValidation" => true,
]);
?>

<div class="form-group">
	<?= $f->field($form, "t")->input("buscar")?> 
</div>

<?= Html::submitButton("Buscar", ["class" => "btn btn-primary"])?>

<?php $f->end() ?>

<h3>Lista de tesis</h3>
<table class= " table table-bordered">
	<tr>
	
		<th>Nombre de la Tesis</th>
		<th>Redactor</th>
		<th>Tutor</th>
		<th>Fecha de Publicacion</th>
				
	</tr>
	<?php foreach ($model as $row): ?>
	<tr>
		<td><?= $row->titulo_tesis ?></td>
		<td><?= $row->redactor_tesis?></td>
		<td><?= $row->tutor_tesis?></td>
		<td><?= $row->fecha_tesis?></td>
				
    </tr>
	<?php endforeach?>
</table>	

<?= LinkPager::widget([
    'pagination' => $pages,
]);
