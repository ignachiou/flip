<?php

use yii\helpers\Html;
use yii\grid\GridView;
use app\models\User;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $searchModel app\models\TesisSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Tesis';
?>
<div class="tesis-index">

	
	
	<?php $form = ActiveForm::begin([
        'action' => ['tesis/index'],
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
    <h3><center>Catálogo de Tesis</center></h3>
        <?php 
    	if(!Yii::$app->user->isGuest)
    	{
    		if(User::isUserAdmin(Yii::$app->user->identity->id) || (User::isUserCatalog(Yii::$app->user->identity->id))){?>
        		
        		<center><?= Html::a('Crear Tesis', ['create'], ['class' => 'btn btn-success']) ?></center>
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

            'titulo_tesis',
            'tutor_tesis',
            'cotutor_tesis',
            'redactor_tesis',
             'fecha_tesis',
            // 'resumen_tesis',
            // 'url:url',
            // 'desc1_tesis',
            // 'desc2_tesis',
            // 'desc3_tesis',
            // 'desc4_tesis',
             'universidad',

            ['class' => 'yii\grid\ActionColumn',
            		'template'=>'{view}{update}',
            		'buttons' => [
            				'update' => function ($url, $model) {
            								if(!Yii::$app->user->isGuest)
            								{
            									if (User::isUserAdmin(Yii::$app->user->identity->id) || User::isUserCatalog(Yii::$app->user->identity->id)) {
           					 						return Html::a('<span class="glyphicon glyphicon-pencil"></span>', ['update', 'id' => $model->id_tesis])
            										. Html::a('<span class="glyphicon glyphicon-trash"></span>', ['delete', 'id' => $model->id_tesis], ['data-method'=> 'post']);
        										}
            								}           					
            						},
            				],            				           		
    		],
        ],
    ]); ?>

</div>
