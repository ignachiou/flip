<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use app\models\User;

$this->title = $model->titulo_revista;
?>
<div class="revista-view">


    <p>
        <?php 
    	if(!Yii::$app->user->isGuest)
    	{
    		if(User::isUserAdmin(Yii::$app->user->identity->id) || (User::isUserCatalog(Yii::$app->user->identity->id))){?>
        		<?= Html::a('Actualizar', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        		<?= Html::a('Borrar', ['delete', 'id' => $model->id], [
           			 'class' => 'btn btn-danger',
            		'data' => [
                	'confirm' => '¿Seguro que quieres borrar este objeto?',
                	'method' => 'post',
            		],
        		]) ?>
        <?php 
    		}
    		}?>
        
        <?= Html::a('Visualizar', ['site/prueba', 
        		'id_revista' => $model->id, 
        		'url_revista' => $model->url_revista,
        		'titulo_revista' => $model->titulo_revista,
        		'editorial_revista' => $model->editorial_revista,
        		'fecha' => $model->fecha_revista,
        		'issn' =>$model->issn_revista,
        ], ['class' => 'btn btn-info']) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            
            'titulo_revista',
            'editorial_revista',
            'volumen_revista',
            'fasciculo_revista',
            'fecha_revista',
            'issn_revista',
            'periodicidad_revista',
        	'desc1',
        	'desc2',
        	'desc3',
        	'desc4',
            
        ],
    ]) ?>

</div>
