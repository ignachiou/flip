<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\RevistaSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Revistas';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="revista-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Revista', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'titulo_revista',
            'editorial_revista',
            'volumen_revista',
            'fasciculo_revista',
            // 'fecha_revista',
            // 'issn_revista',
            // 'periodicidad_revista',
            // 'url_revista:url',
            // 'desc1',
            // 'desc2',
            // 'desc3',
            // 'desc4',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

</div>
