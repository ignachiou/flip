<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\RevistaSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="revista-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'titulo_revista') ?>

    <?= $form->field($model, 'editorial_revista') ?>

    <?= $form->field($model, 'volumen_revista') ?>

    <?= $form->field($model, 'fasciculo_revista') ?>

    <?php // echo $form->field($model, 'fecha_revista') ?>

    <?php // echo $form->field($model, 'issn_revista') ?>

    <?php // echo $form->field($model, 'periodicidad_revista') ?>

    <?php // echo $form->field($model, 'url_revista') ?>

    <?php // echo $form->field($model, 'desc1') ?>

    <?php // echo $form->field($model, 'desc2') ?>

    <?php // echo $form->field($model, 'desc3') ?>

    <?php // echo $form->field($model, 'desc4') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
