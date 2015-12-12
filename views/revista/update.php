<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Revista */

$this->title = 'Actualizar revista: ' . ' ' . $model->id;
?>
<div class="revista-update">


    <?= $this->render('_form', [
        'model' => $model,
    	'modelsArticulo' => $modelsArticulo,
    	'modelsPagina' => $modelsPagina,
    ]) ?>

</div>
