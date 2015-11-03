<?php
use yii\helpers\Url;
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\data\Pagination;
use yii\widgets\LinkPager;
?>



<?php $f = ActiveForm::begin([
		"method" => "get",
		"action" => Url::toRoute("site/registrosrevista"),
		"enableClientValidation" => true,
]);
?>

<div class="form-group">
	<?= $f->field($form, "p")->input("buscar")?> 
</div>

<?= Html::submitButton("Buscar", ["class" => "btn btn-primary"])?>
<?= Html::a("Crear Publicacion",'index.php?r=revista%2Fcreate',["class" => "btn btn-success"])?>

<?php $f->end() ?>

<h3><?= $search ?></h3>	

<h3> Lista de Revistas </h3>
<table class= " table table-bordered">
	<tr>
	
		<th>ID Revista</th>
		<th>Titulo de Revista</th>
		<th>Editorial</th>
		<th>Volumen</th>
		<th>Fasciculo</th>
		<th>Fecha de Publicacion</th>
		<th>issn</th>
		<th>periodicidad</th>
		<th></th>
		<th></th>
		
	</tr>
	<?php foreach ($model as $row): ?>
	<tr>
		<td><?= $row->id?></td>
		<td><?= $row->titulo_revista ?></td>
		<td><?= $row->editorial_revista?></td>
		<td><?= $row->volumen_revista?></td>
		<td><?= $row->fasciculo_revista?></td>
		<td><?= $row->fecha_revista?></td>
		<td><?= $row->issn_revista?></td>
		<td><?= $row->periodicidad_revista?></td>
		<td><a href= "<?= Url::toRoute(["site/actualizarrevista", "id" => $row->id]) ?>"><?= Html::submitButton("Editar", ["class" => "btn btn-warning"])?></a></td>
		<td>
            <a href="#" data-toggle="modal" data-target="#id_<?= $row->id ?>"><?= Html::submitButton("Eliminar", ["class" => "btn btn-danger"])?></a>
            <div class="modal fade" role="dialog" aria-hidden="true" id="id_<?= $row->id ?>">
                      <div class="modal-dialog">
                            <div class="modal-content">
                              <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                                    <h4 class="modal-title">Eliminar Revista</h4>
                              </div>
                              <div class="modal-body">
                                    <p>Realmente deseas eliminar la revista con ID <?= $row->id ?>?</p>
                              </div>
                              <div class="modal-footer">
                              <?= Html::beginForm(Url::toRoute("site/eliminarrevista"), "POST") ?>
                                    <input type="hidden" name="id" value="<?= $row->id ?>">
                                    <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                                    <button type="submit" class="btn btn-primary">Eliminar</button>
                              <?= Html::endForm() ?>
                              </div>
                            </div><!-- /.modal-content -->
                      </div><!-- /.modal-dialog -->
            </div><!-- /.modal -->
        </td>
    </tr>
	<?php endforeach?>
</table>	

<?= LinkPager::widget([
    'pagination' => $pages,
]);
