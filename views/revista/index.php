<?php

use yii\helpers\Html;
use yii\grid\GridView;
use app\models\User;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $searchModel app\models\RevistaSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Revistas';
?>
<div class="revista-index">

	
	
	<?php $form = ActiveForm::begin([
        'action' => ['revista/index'],
        'method' => 'get',
    ]); ?>

    	<center>
       <?= $form->field($searchModel, 'busquedag') ?>
	</center>
	
    <div class="form-group">
        <center><?= Html::submitButton('Buscar', ['class' => 'btn btn-default']) ?></center>
    </div>

    <?php ActiveForm::end(); ?>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
    	<h3><center>Catálogo de Publicaciones</center></h3>
        <?php 
    	if(!Yii::$app->user->isGuest)
    	{
    		if(User::isUserAdmin(Yii::$app->user->identity->id) || (User::isUserCatalog(Yii::$app->user->identity->id))){?>
        		
        		<center><?= Html::a('Crear Publicación', ['create'], ['class' => 'btn btn-success']) ?></center>
        <?php 
    		}
    		}?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
    		'summary' => '',
    		'emptyText' => 'No hubo resultados',
    		'tableOptions' => ['class' => 'table  table-bordered table-hover'],
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'titulo_revista',
            'editorial_revista',
            'volumen_revista',
            'fasciculo_revista',
             'fecha_revista',
             'issn_revista',
            // 'periodicidad_revista',
            // 'url_revista:url',
            // 'desc1',
            // 'desc2',
            // 'desc3',
            // 'desc4',

            ['class' => 'yii\grid\ActionColumn',
            		'template'=>'{view}{update}',
            		'buttons' => [
            				'update' => function ($url, $model) {
            								if(!Yii::$app->user->isGuest)
            								{
            									if (User::isUserAdmin(Yii::$app->user->identity->id) || User::isUserCatalog(Yii::$app->user->identity->id)) {
           					 						return Html::a('<span class="glyphicon glyphicon-pencil"></span>', ['update', 'id' => $model->id])
            										. Html::a('<span class="glyphicon glyphicon-trash"></span>', ['delete', 'id' => $model->id], ['data-method'=> 'post']);
        										}
            								}           					
            						},
            				],            				           		
    		],
        ],
    ]); ?>

</div>
