<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $name string */
/* @var $message string */
/* @var $exception Exception */

$this->title = $name;
?>
<div class="site-error">

    <h1><?= Html::encode($this->title) ?></h1>

    <div class="alert alert-danger">
        <?= nl2br(Html::encode($message)) ?>
    </div>

    <p>
        El siguiente error ocurrio mientras nuestro servidor procesaba su requerimiento.
    </p>
    <p>
        Por favor contactanos si crees que existe algun error en nuestro servidor.
    </p>

</div>
