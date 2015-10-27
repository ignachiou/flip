<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\Url;
?>

<a href="<?= Url::toRoute("site/registrostesis") ?>">Ir a la lista de Tesis </a>


<h1>Crear Tesis</h1>
<h3><?= $msg ?></h3>

<?php $form = ActiveForm::begin([
    "method" => "post",
 	'enableClientValidation' => true,
		"options" => ["enctype" => "multipart/form-data"],
]);
?>




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
 <?= $form->field($model, "universidad")->input("text") ?>   
</div>

<div class="form-group">
 <?= $form->field($model, "resumen")->input("text") ?>   
</div>

<div class="form-group">
 <?= $form->field($model, "fecha_de_publicacion")->input("text") ?>   
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

<?= $form->field($model, "img[]")->fileInput(['multiple' => true]) ?>


<?= Html::submitButton("Crear", ["class" => "btn btn-primary"])?>

<?php $form->end() ?>