<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\PaginaSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="pagina-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'descripcion') ?>

    <?= $form->field($model, 'url') ?>

    <?= $form->field($model, 'dependencia') ?>

    <?= $form->field($model, 'tesis') ?>

    <?php // echo $form->field($model, 'publicaciones') ?>

    <?php // echo $form->field($model, 'articulo') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
