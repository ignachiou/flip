<?php
use yii\helpers\Url;
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\data\Pagination;
use yii\widgets\LinkPager;
?>

<a href="<?= URL::toRoute("site/crear")?>">Crear un nuevo registro de una monografia</a>

<?php $f = ActiveForm::begin([
		"method" => "get",
		"action" => Url::toRoute("site/registros"),
		"enableClientValidation" => true,
]);
?>

<div class="form-group">
	<?= $f->field($form, "m")->input("buscar")?> 
</div>

<?= Html::submitButton("Buscar", ["class" => "btn btn-primary"])?>

<?php $f->end() ?>

<h3><?= $search ?></h3>	

<h3> Lista de Monografias </h3>
<table class= " table table-bordered">
	<tr>
	
		<th> ID Monografia</th>
		<th>Nombre de Monografia</th>
		<th>Autor de Monografia</th>
		<th>Editorial Monografia</th>
		<th>Fecha de Publicacion</th>
		<th></th>
		<th></th>
									
	</tr>
	<?php foreach ($model as $row): ?>
	<tr>
		
		<td><?= $row->id_objeto?></td>
		<td><a href= "<?= Url::toRoute(["site/prueba", "id_objeto" => $row->id_objeto, "url" => $row->url]) ?>"><?= $row->nombre ?></a></td>
		<td><?= $row->autor?></td>
		<td><?= $row->editorial?></td>
		<td><?= $row->fecha?></td>
		<td><a href= "<?= Url::toRoute(["site/actualizar", "id_objeto" => $row->id_objeto]) ?>">Editar</a></td>
		<td>
            <a href="#" data-toggle="modal" data-target="#id_objeto_<?= $row->id_objeto ?>">Eliminar</a>
            <div class="modal fade" role="dialog" aria-hidden="true" id="id_objeto_<?= $row->id_objeto ?>">
                      <div class="modal-dialog">
                            <div class="modal-content">
                              <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                                    <h4 class="modal-title">Eliminar Monografias</h4>
                              </div>
                              <div class="modal-body">
                                    <p>Realmente deseas eliminar la Monografia "<?= $row->nombre ?>" con ID <?= $row->id_objeto ?>?</p>
                              </div>
                              <div class="modal-footer">
                              <?= Html::beginForm(Url::toRoute("site/eliminar"), "POST") ?>
                                    <input type="hidden" name="id_objeto" value="<?= $row->id_objeto ?>">
                                    <button type="button" class="btn btn-primary" data-dismiss="modal">Cerrar</button>
                                    <button type="submit" class="btn btn-danger">Eliminar</button>
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
