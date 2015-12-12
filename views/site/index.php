<?php
use yii\helpers\Url;
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\data\Pagination;
use yii\widgets\LinkPager; 
use yii\base\Model;
?>
<!DOCTYPE html>
<head>

</head>

<body>
<?php
/* @var $this yii\web\View */
$this->title = 'Bibliotheca';
?>
<div id="index" class="site-index">
		<br>
		<br>
		<center><img class="frontImage"  src="imagenes/gif/big_logo.png"></center>
	
    <div class="jumbotron"> 
            
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
        
    </div>

    <div class="body-content">

        

    </div>
</div>

</body>