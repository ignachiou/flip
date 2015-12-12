<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\Url;
?>

<?= Html::a("Usuarios Registrados",'index.php?r=site%2Fadmin',["class" => "btn btn-success"])?>


<h1>Editar el Usuario con ID <?= Html::encode($_GET["id"]) ?></h1>

<h3><?= $msg?></h3>

<?php $form = ActiveForm::begin([
    "method" => "post",
    'enableClientValidation' => true,
]);
?>

<?= $form->field($model, "id")->input("hidden")->label(false) ?>

<div class="form-group">
 <?= $form->field($model, "usuario")->input("text") ?>   
</div>

<div class="form-group">
 <?= $form->field($model, "email")->input("text") ?>   
</div>

<div class="form-group">
 <?= $form->field($model, "rol")->input("text") ?>   
</div>

<h5>Tips: recordar que los valores de rol van del 1 al 3, donde:<br>
	1=Usuario Registrado<br>
	2=Usuario Catalogador(crear,modificar o eliminar objetos)<br>
	3=Super Usuario(modifica o elimina usuarios)
</h5>

<?= Html::submitButton("Actualizar", ["class" => "btn btn-success"]) ?>

<?php $form->end() ?>

