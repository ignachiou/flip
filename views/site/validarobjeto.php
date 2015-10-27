<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;

?>

<h1> Insercion de los Objetos Bibliograficos </h1>
<h3><?= $msg ?></h3>

<?php $form = ActiveForm::begin([
		"method" => "post",
		"id" => "formulario",
		 'enableClientValidation' => false,
		"enableAjaxValidation" => true, //se activa la validacion ajax
	
]);
//nombre_objeto debe coincidir con los nombres del modelo
?>

<div class ="form-group">
<?= $form->field($model, "nombre_objeto") -> input("text") ?> 
</div>

<?= Html::submitButton("Guardar", ["class" => "btn btn-primary"]) ?>

<?php $form->end() ?>