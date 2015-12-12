<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Tesis */

$this->title = 'Almacenar Tesis';
?>
<div class="tesis-create">

	<?= Html::a("Catalogo de Tesis",['index'],["class" => "btn btn-success"])?>
    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    	'modelsPagina' => $modelsPagina,
    		
    ]) ?>

</div>
