<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\Url;
?>


<a href="<?= Url::toRoute("site/registrostesis") ?>">Ir a la lista de Tesis</a>

<h1>Editar la Tesis con ID <?= Html::encode($_GET["id_tesis"]) ?></h1>

<h3><?= $msg?></h3>

<?php $form = ActiveForm::begin([
    "method" => "post",
    'enableClientValidation' => true,
]);
?>

<?= $form->field($model, "id_tesis")->input("hidden")->label(false) ?>

<div class="form-group">
 <?= $form->field($model, "titulo")->input("text") ?>   
</div>

<div class="form-group">
 <?= $form->field($model, "redactor")->input("text") ?>   
</div>

<div class="form-group">
 <?= $form->field($model, "tutor")->input("text") ?>   
</div>

<div class="form-group">
 <?= $form->field($model, "cotutor")->input("text") ?>   
</div>

<div class="form-group">
 <?= $form->field($model, "fecha_de_publicacion")->input("text") ?>   
</div>

<div class="form-group">
 <?= $form->field($model, "resumen")->input("text") ?>   
</div>

<div class="form-group">
 <?= $form->field($model, "descriptor1_tesis")->input("text") ?>   
</div>

<div class="form-group">
 <?= $form->field($model, "descriptor2_tesis")->input("text") ?>   
</div>

<div class="form-group">
 <?= $form->field($model, "descriptor3_tesis")->input("text") ?>   
</div>

<div class="form-group">
 <?= $form->field($model, "descriptor4_tesis")->input("text") ?>   
</div>

<?= Html::submitButton("Actualizar", ["class" => "btn btn-primary"]) ?>

<?php $form->end() ?>

