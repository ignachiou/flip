<?php
use yii\helpers\Url;
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\data\Pagination;
use yii\widgets\LinkPager;
?>

<?php $f = ActiveForm::begin([
		"method" => "get",
		"action" => Url::toRoute("site/articulo"),
		"enableClientValidation" => true,
]);
?>

<div class="form-group">
	<?= $f->field($form, "a")->input("buscar")?> 
</div>

<?= Html::submitButton("Buscar", ["class" => "btn btn-primary"])?>

<?php $f->end() ?>

<h3>Lista de tesis</h3>
<table class= " table table-bordered">
	<tr>
	
		<th>Nombre del Articulo</th>
		<th>Autor Articulo</th>
				
	</tr>
	<?php foreach ($model as $row): ?>
	<tr>
		<td><?= $row->titulo_articulo?></td>
		<td><?= $row->autor_articulo?></td>
				
    </tr>
	<?php endforeach?>
</table>	

<?= LinkPager::widget([
    'pagination' => $pages,
]);
