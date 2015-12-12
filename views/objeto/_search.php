<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\ObjetoSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="objeto-search">

    <?php $f = $form = ActiveForm::begin([
        'action' => ['objeto/index'],
        'method' => 'get',
    ]); ?>

       <?= $f->$form->field($model, 'busquedag') ?>

    <?php // echo $form->field($model, 'url') ?>

    <?php // echo $form->field($model, 'desc1') ?>

    <?php // echo $form->field($model, 'desc2') ?>

    <?php // echo $form->field($model, 'desc3') ?>

    <?php // echo $form->field($model, 'desc4') ?>

    <?php // echo $form->field($model, 'resumen') ?>

    <?php // echo $form->field($model, 'isbn') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        
    </div>

    <?php $f->end(); ?>

</div>
