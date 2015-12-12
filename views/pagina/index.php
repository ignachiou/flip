<?php

use yii\helpers\Html;
use yii\grid\GridView;
use app\models\User;

/* @var $this yii\web\View */
/* @var $searchModel app\models\PaginaSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Paginas';
?>
<div class="pagina-index">

    <h3><center>Registro de Páginas de los Objetos Bibliográficos</center></h3>
    <br>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

   

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
    	'summary' => '',
    		'emptyText' => 'No hubo resultados',
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'descripcion',
            'url',
            // 'publicaciones',
            // 'articulo',

            ['class' => 'yii\grid\ActionColumn',
            		'template'=>'{view}',
            		           				           		
    		], 
        ],
    ]); ?>

</div>
