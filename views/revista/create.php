<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Revista */

$this->title = 'Crear Publicacion';


?>
<div class="revista-create">
	<?= Html::a("Catalogo de Publicaciones",'index.php?r=site%2Fregistrosrevista',["class" => "btn btn-success"])?>
    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    	'modelsArticulo' => $modelsArticulo,
    ]) ?>

</div>
