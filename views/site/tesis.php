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
	<center><?= $f->field($form, "t")->input("buscar")?></center> 
</div>

<center><?= Html::submitButton("Buscar", ["class" => "btn btn-primary"])?></center>

<?php $f->end() ?>

<h3>Lista de tesis</h3>
<table class= " table table-striped">
	<tr>
	
		<th>Nombre de la Tesis</th>
		<th>Redactor</th>
		<th>Tutor</th>
		<th>Fecha de Publicacion</th>
				
	</tr>
	<?php foreach ($model as $row): ?>
	<tr>
		<td><a href= "<?= Url::toRoute(["site/prueba1", "id_tesis" => $row->id_tesis, "url" => $row->url]) ?>"><?= $row->titulo_tesis ?></td>
		<td><?= $row->redactor_tesis?></td>
		<td><?= $row->tutor_tesis?></td>
		<td><?= $row->fecha_tesis?></td>
				
    </tr>
	<?php endforeach?>
</table>	

<?= LinkPager::widget([
    'pagination' => $pages,
]);
