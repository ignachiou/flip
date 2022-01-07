<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Objeto */

$this->title = 'Guardar Monográfia';
?>
<div class="objeto-create">

	
	<?= Html::a("Catalogo de Monográfias",['index'],["class" => "btn btn-success"])?>
    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    	'modelsPagina' => $modelsPagina,
    ]) ?>

</div>
