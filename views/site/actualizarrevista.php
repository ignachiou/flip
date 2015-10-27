<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\Url;
?>


<a href="<?= Url::toRoute("site/registrosrevista") ?>">Ir a la lista de Revistas</a>

<h1>Editar la Revista con ID <?= Html::encode($_GET["id"]) ?></h1>

<h3><?= $msg?></h3>

<?php $form = ActiveForm::begin([
    "method" => "post",
    'enableClientValidation' => true,
]);
?>

<?= $form->field($model, "id")->input("hidden")->label(false) ?>

<div class="form-group">
 <?= $form->field($model, "titulo_revista")->input("text") ?>   
</div>

<div class="form-group">
 <?= $form->field($model, "editorial_revista")->input("text") ?>   
</div>

<div class="form-group">
 <?= $form->field($model, "volumen_revista")->input("text") ?>   
</div>

<div class="form-group">
 <?= $form->field($model, "fasciculo_revista")->input("text") ?>   
</div>

<div class="form-group">
 <?= $form->field($model, "fecha_revista")->input("text") ?>   
</div>

<div class="form-group">
 <?= $form->field($model, "issn_revista")->input("text") ?>   
</div>

<div class="form-group">
 <?= $form->field($model, "periodicidad_revista")->input("text") ?>   
</div>

<div class="form-group">
 <?= $form->field($model, "desc1")->input("text") ?>   
</div>

<div class="form-group">
 <?= $form->field($model, "desc2")->input("text") ?>   
</div>

<div class="form-group">
 <?= $form->field($model, "desc3")->input("text") ?>   
</div>

<div class="form-group">
 <?= $form->field($model, "desc4")->input("text") ?>   
</div>


<?= Html::submitButton("Actualizar", ["class" => "btn btn-primary"]) ?>

<?php $form->end() ?>

