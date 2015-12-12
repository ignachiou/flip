<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use app\models\User;


$this->title = $model->titulo_tesis;
?>
<div class="tesis-view">

    <p>
        <?php 
    	if(!Yii::$app->user->isGuest)
    	{
    		if(User::isUserAdmin(Yii::$app->user->identity->id) || (User::isUserCatalog(Yii::$app->user->identity->id))){?>
        		<?= Html::a('Actualizar', ['update', 'id' => $model->id_tesis], ['class' => 'btn btn-primary']) ?>
        		<?= Html::a('Borrar', ['delete', 'id' => $model->id_tesis], [
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
        		'id_tesis' => $model->id_tesis, 
        		'url' => $model->url,
        		'titulo_tesis' => $model->titulo_tesis,
        		'redactor' => $model->redactor_tesis,
        		'tutor' => $model->tutor_tesis,
        		'universidad' =>$model->universidad,
        		'fecha_tesis' =>$model->fecha_tesis,
        ], ['class' => 'btn btn-info']) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
          
            'titulo_tesis',
            'tutor_tesis',
            'cotutor_tesis',
            'redactor_tesis',
            'fecha_tesis',
            'resumen_tesis',
            'universidad',
            'desc1_tesis',
            'desc2_tesis',
            'desc3_tesis',
            'desc4_tesis',
            
        ],
    ]) ?>

</div>
