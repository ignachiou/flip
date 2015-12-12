<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use wbraganca\dynamicform\DynamicFormWidget;

/* @var $this yii\web\View */
/* @var $model app\models\Objeto */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="objeto-form">

    <?php $form = ActiveForm::begin(["options" => ["enctype" => "multipart/form-data",'id' => 'dynamic-form']]); ?>

    <?= $form->field($model, 'nombre')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'autor')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'editorial')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'fecha')->textInput(['maxlength' => true]) ?>
    
    <?= $form->field($model, 'resumen')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'isbn')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'desc1')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'desc2')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'desc3')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'desc4')->textInput(['maxlength' => true]) ?>
    
    <div class="row">
    
    <div class="panel panel-default">
        <div class="panel-heading"><h4><i class="glyphicon glyphicon-envelope"></i> Descripción de las Páginas</h4></div>
        <div class="panel-body">
             <?php DynamicFormWidget::begin([
                'widgetContainer' => 'dynamicform_wrapper', // required: only alphanumeric characters plus "_" [A-Za-z0-9_]
                'widgetBody' => '.container-items', // required: css class selector
                'widgetItem' => '.item', // required: css class
                'limit' => 5000, // the maximum times, an element can be cloned (default 999)
                'min' => 1, // 0 or 1 (default 1)
                'insertButton' => '.add-item', // css class
                'deleteButton' => '.remove-item', // css class
                'model' => $modelsPagina[0],
                'formId' => 'dynamic-form',
                'formFields' => [
                    'Descripcion',
                		'img'
                ],
            ]); ?>

            <div class="container-items"><!-- widgetContainer -->
            <?php foreach ($modelsPagina as $i => $modelPagina): ?>
                <div class="item panel panel-default"><!-- widgetBody -->
                    <div class="panel-heading">
                        <h3 class="panel-title pull-left">Página</h3>
                        <div class="pull-right">
                            <button type="button" class="add-item btn btn-success btn-xs"><i class="glyphicon glyphicon-plus"></i></button>
                            <button type="button" class="remove-item btn btn-danger btn-xs"><i class="glyphicon glyphicon-minus"></i></button>
                        </div>
                        <div class="clearfix"></div>
                    </div>
                    <div class="panel-body">
                        <?php
                            // necessary for update action.
                            if (! $modelPagina->isNewRecord) {
                                echo Html::activeHiddenInput($modelPagina, "[{$i}]id");
                            }
                        ?>
                        <div class="row">
                            <div class="col-sm-6">
                                <?= $form->field($modelPagina, "[{$i}]descripcion")->textInput(['maxlength' => true]) ?>
                            </div>
                            <div class="col-sm-6">
                                <?= $form->field($modelPagina, "[{$i}]img")->fileInput(); ?>
                            </div>
                        </div><!-- .row -->
                        
                    </div>
               		</div>
               	</div>
            <?php endforeach; ?>
            </div>
            <?php DynamicFormWidget::end(); ?>
        </div>
      </div>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Crear' : 'Actualizar', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
