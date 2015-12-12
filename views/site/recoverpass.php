<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
$this->title = 'Recuperar Clave';
?>
 
<h3><?= $msg ?></h3>
 
<h1>Recuperar Clave</h1>
<?php $form = ActiveForm::begin([
    'method' => 'post',
    'enableClientValidation' => true,
]);
?>
 
<div class="form-group">
 <?= $form->field($model, "email")->input("email") ?>  
</div>
 
<?= Html::submitButton("Recuperar clave", ["class" => "btn btn-success"]) ?>
 
<?php $form->end() ?>