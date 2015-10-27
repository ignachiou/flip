<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\Url;
use yii\helpers\ArrayHelper;
use app\models\Revista;
use wbraganca\dynamicform\DynamicFormWidget;
?>


<a href="<?= Url::toRoute("site/registrosrevista") ?>">Ir a la lista de Revistas </a>

<h1>Crear Articulos</h1>
<h3><?= $msg ?></h3>

<?php $form = ActiveForm::begin([
    "method" => "post",
 	'enableClientValidation' => true,
		"options" => ["enctype" => "multipart/form-data"],'id' => 'dynamic-form'
]);
?>

<div class="form-group">
 <?= $form->field($model, "titulo_articulo")->input("text") ?>   
</div>

<div class="form-group">
 <?= $form->field($model, "autor")->input("text") ?>   
</div>

<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "biblio";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
     die("Connection failed: " . $conn->connect_error);
} 

$sql = "SELECT max(id_revista) FROM revista";
$result = $conn->query($sql);


     // output data of each row
    // $row = $result;
     $row = $result->fetch_assoc();
     $last = $row["max(id_revista)"];
     echo "<br> id: ". $last.  "<br>";


?>

<div class="form-group">
 <?= $form->field($model, "id_revista")->input("text"); 
 
 //dropDownList(ArrayHelper::map(Revista::find()->all(),'id_revista','id_revista') 		)
 ?>
</div>

<div class="form-group">
 <?= $form->field($model, "resumen")->input("text") ?>   
</div>

<div class="form-group">
 <?= $form->field($model, "descriptor_1")->input("text") ?>   
</div>

<div class="form-group">
 <?= $form->field($model, "descriptor_2")->input("text") ?>   
</div>

<div class="form-group">
 <?= $form->field($model, "descriptor_3")->input("text") ?>   
</div>

<div class="form-group">
 <?= $form->field($model, "descriptor_4")->input("text") ?>   
</div>



<?php $form = ActiveForm::begin(['id' => 'dynamic-form']);?>

<div class="row">
<div class="panel panel-default">
        <div class="panel-heading"><h4><i class="glyphicon glyphicon-envelope"></i> Articulos</h4></div>
        <div class="panel-body">
             <?php DynamicFormWidget::begin([
                'widgetContainer' => 'dynamicform_wrapper', // required: only alphanumeric characters plus "_" [A-Za-z0-9_]
                'widgetBody' => '.container-items', // required: css class selector
                'widgetItem' => '.item', // required: css class
                'limit' => 4, // the maximum times, an element can be cloned (default 999)
                'min' => 1, // 0 or 1 (default 1)
                'insertButton' => '.add-item', // css class
                'deleteButton' => '.remove-item', // css class
                'model' => $modelsArticulo[0],
                'formId' => 'dynamic-form',
                'formFields' => [
                    'titulo_articulo',
                    'resumen_articulo'
                ],
            ]); ?>

            <div class="container-items"><!-- widgetContainer -->
            <?php foreach ($modelsArticulo as $i => $modelArticulo): ?>
                <div class="item panel panel-default"><!-- widgetBody -->
                    <div class="panel-heading">
                        <h3 class="panel-title pull-left">Articulo</h3>
                        <div class="pull-right">
                            <button type="button" class="add-item btn btn-success btn-xs"><i class="glyphicon glyphicon-plus"></i></button>
                            <button type="button" class="remove-item btn btn-danger btn-xs"><i class="glyphicon glyphicon-minus"></i></button>
                        </div>
                        <div class="clearfix"></div>
                    </div>
                    <div class="panel-body">
                        <?php
                            // necessary for update action.
                            if (! $modelArticulo->isNewRecord) {
                                echo Html::activeHiddenInput($modelArticulo, "[{$i}]id");
                            }
                        ?>
                        
                        <div class="row">
                            <div class="col-sm-6">
                                <?= $form->field($modelArticulo, "[{$i}]resumen_articulo")->textInput(['maxlength' => true]) ?>
                            </div>
                            <div class="col-sm-6">
                                <?= $form->field($modelArticulo, "[{$i}]titulo_articulo")->textInput(['maxlength' => true]) ?>
                            </div>
                        </div><!-- .row -->
                    </div>
                </div>
            <?php endforeach; ?>
            </div>
            <?php DynamicFormWidget::end(); ?>
        </div>
    </div>

</div>


<?= Html::submitButton("Crear", ["class" => "btn btn-primary"])?>

<?php $form->end() ?>