<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

use app\models\User;


$this->title = $model->descripcion;
?>
<div class="pagina-view">


    <p>
        
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'descripcion',
            'url',
            'dependencia',
            'tesis',
            'publicaciones',
            'articulo',
        ],
    ]) ?>

</div>
