<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
?>

<h3><?= $msg ?></h3>

<h1>Registro de usuarios</h1>
<?php $form = ActiveForm::begin([
    'method' => 'post',
 'id' => 'formulario',
 'enableClientValidation' => false,
 'enableAjaxValidation' => true,
]);
?>
<div class="form-group">
 <?= $form->field($model, "usuario")->input("text") ?>   
</div>

<div class="form-group">
 <?= $form->field($model, "email")->input("email") ?>   
</div>

<div class="form-group">
 <?= $form->field($model, "clave")->input("password") ?>   
</div>

<div class="form-group">
 <?= $form->field($model, "repita_clave")->input("password") ?>   
</div>

<?= Html::submitButton("Registrate", ["class" => "btn btn-primary"]) ?>

<?php $form->end() ?>