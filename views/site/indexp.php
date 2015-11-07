<?php
use yii\helpers\Url;
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\data\Pagination;
use yii\widgets\LinkPager; 
use yii\base\model;
?>

<?php
/* @var $this yii\web\View */
$this->title = 'Bibliotheca';
?>
<div class="site-index">
		<br>
		<br>
		<center><img WIDTH=450, HEIGTH=300 align=center src="imagenes/gif/big_logo.png"></center>
    <div class="jumbotron">
        

        
        <?php $f = ActiveForm::begin([  
		"method" => "get",
		"action" => Url::toRoute("site/publicaciones"),
		"enableClientValidation" => true,
]);
?>
   	       
    <div class="form-group">
	<?= $f->field($form, "p")->input("buscar")?> 
	</div>

<?= Html::submitButton("Buscar", ["class" => "btn btn-primary"])?>

<?php $f->end() ?>

<h3><?= $search ?></h3>

       
    </div>

    <div class="body-content">

        

    </div>
</div>
