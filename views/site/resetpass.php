<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
$this->title = 'Recuperar Clave';
?>
 
<h3><?= $msg ?></h3>
 
<h1>Restablecer Clave</h1>
<?php $form = ActiveForm::begin([
    'method' => 'post',
    'enableClientValidation' => true,
]);
?>

<div class="form-group">
 <?= $form->field($model, "email")->input("email") ?>  
</div>
 
<div class="form-group">
 <?= $form->field($model, "clave")->input("clave") ?>  
</div>
 
<div class="form-group">
 <?= $form->field($model, "password_repeat")->input("password") ?>  
</div>

<div class="form-group">
 <?= $form->field($model, "verification_code")->input("text") ?>  
</div>

<div class="form-group">
 <?= $form->field($model, "recover")->input("hidden")->label(false) ?>  
</div>
 
<?= Html::submitButton("Restablecer", ["class" => "btn btn-success"]) ?>
 
<?php $form->end() ?>
