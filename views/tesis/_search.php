<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;


?>

<div class="tesis-search">

    <?php $form = ActiveForm::begin([
        'action' => ['tesis/index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id_tesis') ?>

    <?= $form->field($model, 'titulo_tesis') ?>

    <?= $form->field($model, 'tutor_tesis') ?>

    <?= $form->field($model, 'cotutor_tesis') ?>

    <?= $form->field($model, 'redactor_tesis') ?>

    <?php // echo $form->field($model, 'fecha_tesis') ?>

    <?php // echo $form->field($model, 'resumen_tesis') ?>

    <?php // echo $form->field($model, 'url') ?>

    <?php // echo $form->field($model, 'desc1_tesis') ?>

    <?php // echo $form->field($model, 'desc2_tesis') ?>

    <?php // echo $form->field($model, 'desc3_tesis') ?>

    <?php // echo $form->field($model, 'desc4_tesis') ?>

    <?php // echo $form->field($model, 'universidad') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
