<?php

use yii\helpers\Html;
use yii\grid\GridView;
use app\models\User;
use yii\widgets\ActiveForm;


$this->title = 'Articulos';
?>
<div class="articulo-index">

	
	
	<?php $form = ActiveForm::begin([
        'action' => ['articulo/index'],
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

	<h3><center>Catálogo de Articulos</center></h3>
	
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
    	'summary' => '',
    		'emptyText' => 'No hubo resultados',
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            
            'titulo_articulo',
            'autor_articulo',
            'resumen_articulo',
            // 'desc1',
            // 'desc2',
            // 'desc3',
            // 'desc4',

            ['class' => 'yii\grid\ActionColumn',
            		'template'=>'{view}',
            		       				           		
    		], 
        ],
    ]); ?>

</div>
