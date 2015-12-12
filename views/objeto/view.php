<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\helpers\Url;
use app\models\User; 
use app\controllers\SiteController;


$this->title = $model->nombre;
?>
<div class="objeto-view">


    <p>
    	<?php 
    	if(!Yii::$app->user->isGuest)
    	{
    		if(User::isUserAdmin(Yii::$app->user->identity->id) || (User::isUserCatalog(Yii::$app->user->identity->id))){?>
        		<?= Html::a('Actualizar', ['update', 'id' => $model->id_objeto], ['class' => 'btn btn-primary']) ?>
        		<?= Html::a('Borrar', ['delete', 'id' => $model->id_objeto], [
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
        		'id_objeto' => $model->id_objeto, 
        		'url' => $model->url,
        		'nombre' => $model->nombre,
        		'autor' => $model->autor,
        		'editorial' => $model->editorial,
        		'isbn' =>$model->isbn,
        ], ['class' => 'btn btn-info']) ?>
        
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'nombre',
            'autor',
            'editorial',
            'fecha',
            'resumen',
            'isbn',
        	'desc1',
        	'desc2',
        	'desc3',
        	'desc4',
        		
        ],
    ]) ?>

</div>
