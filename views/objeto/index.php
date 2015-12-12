<?php

use yii\helpers\Html;
use yii\grid\GridView;
use app\models\User;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $searchModel app\models\ObjetoSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Objetos';
?>
<div class="objeto-index">



    <?php $form = ActiveForm::begin([
        'action' => ['objeto/index'],
        'method' => 'get',
    ]); ?>

    	<center>
       <?= $form->field($searchModel, 'busquedag') ?>
	</center>
	
    <div class="form-group">
        <center><?= Html::submitButton('Buscar', ['class' => 'btn btn-default']) ?></center>
    </div>

    <?php ActiveForm::end(); ?>
                                                                                                        
    <p>
    	<h3><center>Catálogo de Monográfias</center></h3>
    	<center><?php 
    	if(!Yii::$app->user->isGuest)
    	{
    		if(User::isUserAdmin(Yii::$app->user->identity->id) || (User::isUserCatalog(Yii::$app->user->identity->id))){?>
        		
        		<?= Html::a('Crear Monográfia', ['create'], ['class' => 'btn btn-success']) ?>
        <?php 
    		}
    		}?></center>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
    	'summary' => '', 
    	'emptyText' => 'No hubo resultados',
    	'tableOptions' => ['class' => 'table  table-bordered table-hover'],
        'columns' => [
        		['class' => 'yii\grid\SerialColumn'],

            'nombre',
            'autor',
            'editorial',
            'fecha',
            // 'url:url',
            // 'desc1',
            // 'desc2',
            // 'desc3',
            // 'desc4',
            // 'resumen',
             'isbn',

            ['class' => 'yii\grid\ActionColumn',
            		'template'=>'{view}{update}',
            		'buttons' => [
            				'update' => function ($url, $model) {
            								if(!Yii::$app->user->isGuest)
            								{
            									if (User::isUserAdmin(Yii::$app->user->identity->id) || User::isUserCatalog(Yii::$app->user->identity->id)) {
           					 						return Html::a('<span class="glyphicon glyphicon-pencil"></span>', ['update', 'id' => $model->id_objeto])
            										. Html::a('<span class="glyphicon glyphicon-trash"></span>', ['delete', 'id' => $model->id_objeto], ['data-method'=> 'post']);
        										}
            								}           					
            						},
            				],            				           		
    		],       		
        ],
    ]); ?>

</div>
