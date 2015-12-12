<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Objeto */

$this->title = 'Actuazalir Objeto: ' . ' ' . $model->id_objeto;
?>
<div class="objeto-update">


    <?= $this->render('_form', [
        'model' => $model,
    	'modelsPagina' => $modelsPagina,
    ]) ?>

</div>
