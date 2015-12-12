<?php
use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use app\assets\AppAsset;

/* @var $this \yii\web\View */
/* @var $content string */

AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" href="css/index.css" media="screen" />
     
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>
<body>

<?php $this->beginBody() ?>
    <div class="wrap">
        <?php
            NavBar::begin([
                'brandLabel' => 'BIBLIOTHECA',
                'brandUrl' => Yii::$app->homeUrl,
                'options' => [
                    'class' => 'my-navbar navbar-fixed-top',
                ],
            ]);
            echo nav::widget([
                'options' => ['class' => 'navbar-nav navbar-left'],
                'items' => [
                    ['label' => 'Inicio', 'url' => ['/site/index']],
                		['label' => 'Busqueda', 'items' =>[
                				['label' => 'Monografias', 'url' => ['/site/index']],
                				['label' => 'Tesis', 'url' => ['/site/indext']],
                				['label' => 'Publicaciones Periodicas', 'url' => ['/site/indexp']], 
                				['label' => 'Articulos', 'url' => ['/site/indexa']],
                											]                				
                		],
                    ['label' => 'Acerca de', 'url' => ['/site/about']],
                    ['label' => 'Contactenos', 'url' => ['/site/contact']],
                	
                ],
            ]);
            echo Nav::widget([
            		'options' => ['class' => 'navbar-nav navbar-right'],
            		'items' => [
            				          				
            				Yii::$app->user->isGuest ?
            				['label' => 'Ingresar', 'url' => ['/site/login']] :
            				['label' => 'Salir (' . Yii::$app->user->identity->usuario . ')',
            						'url' => ['/site/logout'],
            						'linkOptions' => ['data-method' => 'post']],
            		            			
            		],
            ]);
            
            NavBar::end();
        ?>

        <div class="container">
            <?= Breadcrumbs::widget([
                'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
            ]) ?>
            <?= $content ?>
        </div>
    </div>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
