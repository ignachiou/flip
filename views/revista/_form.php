<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use wbraganca\dynamicform\DynamicFormWidget;
use yii\helpers\url;

/* @var $this yii\web\View */
/* @var $model app\models\Revista */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="revista-form">

	<?php $form = ActiveForm::begin([
    "method" => "post",
 	'enableClientValidation' => true,
		"options" => ["enctype" => "multipart/form-data"],'id' => 'dynamic-form'
]); ?>

    <?= $form->field($model, 'titulo_revista')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'editorial_revista')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'volumen_revista')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'fasciculo_revista')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'fecha_revista')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'issn_revista')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'periodicidad_revista')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'desc1')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'desc2')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'desc3')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'desc4')->textInput(['maxlength' => true]) ?>
    
    
    <hr>
    
    
    
      <div class="row1">
    
    <div class="panel panel-default">
        <div class="panel-heading"><h4><i class="glyphicon glyphicon-envelope"></i> Descripción de las Páginas</h4></div>
        <div class="panel-body">
             <?php DynamicFormWidget::begin([
                'widgetContainer' => 'dynamicform_wrapper', // required: only alphanumeric characters plus "_" [A-Za-z0-9_]
                'widgetBody' => '.container-items', // required: css class selector
                'widgetItem' => '.item1', // required: css class
                'limit' => 5000, // the maximum times, an element can be cloned (default 999)
                'min' => 1, // 0 or 1 (default 1)
                'insertButton' => '.add-item1', // css class
                'deleteButton' => '.remove-item1', // css class
                'model' => $modelsPagina[0],
                'formId' => 'dynamic-form',
                'formFields' => [
                    'Descripcion',
                		'img'
                ],
            ]); ?>

            <div class="container-items"><!-- widgetContainer -->
            <?php foreach ($modelsPagina as $i => $modelPagina): ?>
                <div class="item1 panel panel-default"><!-- widgetBody -->
                    <div class="panel-heading">
                        <h3 class="panel-title pull-left">Página <?php echo $i[$modelPagina]?></h3>
                        <div class="pull-right">
                            <button type="button" class="add-item1 btn btn-success btn-xs"><i class="glyphicon glyphicon-plus"></i></button>
                            <button type="button" class="remove-item1 btn btn-danger btn-xs"><i class="glyphicon glyphicon-minus"></i></button>
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
    
    <hr>    
    
    
    
    <div class="row2">
    
    <div class="panel panel-default">
        <div class="panel-heading"><h4><i class="glyphicon glyphicon-envelope"></i> Articulos de la Publicación</h4></div>
        <div class="panel-body">
             <?php DynamicFormWidget::begin([
                'widgetContainer' => 'dynamicform_wrapper', // required: only alphanumeric characters plus "_" [A-Za-z0-9_]
                'widgetBody' => '.container-items', // required: css class selector
                'widgetItem' => '.item', // required: css class
                'limit' => 20, // the maximum times, an element can be cloned (default 999)
                'min' => 1, // 0 or 1 (default 1)
                'insertButton' => '.add-item', // css class
                'deleteButton' => '.remove-item', // css class
                'model' => $modelsArticulo[0],
                'formId' => 'dynamic-form',
                'formFields' => [
                    	'titulo_revista',
                    	'autor_revista',
                		'resumen_articulo',
                		'desc1',
                		'desc2',
                		'desc3',
                		'desc4',
                		'pagina',
                ],
            ]); ?>

            <div class="container-items"><!-- widgetContainer -->
            <?php foreach ($modelsArticulo as $i => $modelsArticulo): ?>
                <div class="item panel panel-default"><!-- widgetBody -->
                    <div class="panel-heading">
                        <h3 class="panel-title pull-left">Articulo</h3>
                        <div class="pull-right">
                            <button type="button" class="add-item btn btn-success btn-xs"><i class="glyphicon glyphicon-plus"></i></button>
                            <button type="button" class="remove-item btn btn-danger btn-xs"><i class="glyphicon glyphicon-minus"></i></button>
                        </div>
                        <div class="clearfix"></div>
                    </div>
                    <div class="panel-body">
                        <?php
                            // necessary for update action.
                            if (! $modelsArticulo->isNewRecord) {
                                echo Html::activeHiddenInput($modelsArticulo, "[{$i}]id_articulo");
                            }
                        ?>
                        
                        <div class="row">
                            <div class="col-sm-6">
                                <?= $form->field($modelsArticulo, "[{$i}]titulo_articulo")->textInput(['maxlength' => true]) ?>
                            </div>
                            <div class="col-sm-6">
                                <?= $form->field($modelsArticulo, "[{$i}]autor_articulo")->textInput(['maxlength' => true]) ?>
                            </div>
                        </div><!-- .row -->
                        <div class="row">
                            <div class="col-sm-6">
                                <?= $form->field($modelsArticulo, "[{$i}]resumen_articulo")->textInput(['maxlength' => true]) ?>
                            </div>
                            <div class="col-sm-6">
                                <?= $form->field($modelsArticulo, "[{$i}]desc1")->textInput(['maxlength' => true]) ?>
                            </div>
                        </div><!-- .row -->
                        <div class="row">
                            <div class="col-sm-6">
                                <?= $form->field($modelsArticulo, "[{$i}]desc2")->textInput(['maxlength' => true]) ?>
                            </div>
                            <div class="col-sm-6">
                                <?= $form->field($modelsArticulo, "[{$i}]desc3")->textInput(['maxlength' => true]) ?>
                            </div>
                        </div><!-- .row -->
                        <div class="row">
                            <div class="col-sm-6">
                                <?= $form->field($modelsArticulo, "[{$i}]desc4")->textInput(['maxlength' => true]) ?>
                            </div>
                            <div class="col-sm-6">
                                <?= $form->field($modelsArticulo, "[{$i}]pagina")->textInput(['maxlength' => true]) ?>
                            </div>
                        </div><!-- .row -->
                     </div>
                </div>
            <?php endforeach; ?>
            </div>
            <?php DynamicFormWidget::end(); ?>
        </div>
    </div>
    </div>

    <div class="form-group">
       <?= Html::submitButton($model->isNewRecord ? 'Crear' : 'Actualizar', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
