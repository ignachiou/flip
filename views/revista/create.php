<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Revista */

$this->title = 'Almacenar Publicación';


?>
<div class="revista-create">
	<?= Html::a("Catalogo de Publicaciones",['index'],["class" => "btn btn-success"])?>
    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    	'modelsArticulo' => $modelsArticulo,
    	'modelsPagina' => $modelsPagina,
    ]) ?>

</div>
