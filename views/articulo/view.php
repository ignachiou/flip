<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use app\models\User;

$this->title = $model->titulo_articulo;
?>
<div class="articulo-view">

    <p> 
        
        <?= Html::a('Visualizar', ['site/prueba',  
        		'id_revista' => $model->id_revista,
        		'url_revista' => $model->url_revista,
        		'tituloar' => $model->titulo_articulo,
        		'autor_articulo' => $model->autor_articulo,
        		'#' => (($model->url_revista).($model->pagina)),
        ], ['class' => 'btn btn-info']) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'titulo_articulo',
            'autor_articulo',
            'resumen_articulo',
            'desc1',
            'desc2',
            'desc3',
            'desc4',
        ],
    ]) ?>

</div>
