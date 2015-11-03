<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Revista */

$this->title = 'Crear Publicacion';


?>
<div class="revista-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    	'modelsArticulo' => $modelsArticulo,
    ]) ?>

</div>
