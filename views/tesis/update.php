<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Tesis */

$this->title = 'Actualización de Tesis: ' . ' ' . $model->id_tesis;
?>
<div class="tesis-update">


    <?= $this->render('_form', [
        'model' => $model,
    	'modelsPagina' => $modelsPagina,
    ]) ?>

</div>
