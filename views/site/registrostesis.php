<?php
use yii\helpers\Url;
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\data\Pagination;
use yii\widgets\LinkPager;
?>

<a href="<?= URL::toRoute("site/creartesis")?>">Crear un nuevo registro de una tesis</a>

<?php $f = ActiveForm::begin([
		"method" => "get",
		"action" => Url::toRoute("site/registrostesis"),
		"enableClientValidation" => true,
]);
?>

<div class="form-group">
	<?= $f->field($form, "q")->input("buscar")?> 
</div>

<?= Html::submitButton("Buscar", ["class" => "btn btn-primary"])?>

<?php $f->end() ?>

<h3><?= $search ?></h3>	

<h3> Lista de Tesis </h3>
<table class= " table table-bordered">
	<tr>
	
		<th> ID Tesis</th>
		<th>Nombre de Tesis</th>
		<th>Redactor de la Tesis</th>
		<th>Tutor de la Tesis</th>
		<th>Fecha de Publicacion</th>
		<th>Universidad</th>
		<th></th>
		<th></th>
									
	</tr>
	<?php foreach ($model as $row): ?>
	<tr>
		<td><?= $row->id_tesis?></td>
		<td><?= $row->titulo_tesis ?></td>
		<td><?= $row->redactor_tesis?></td>
		<td><?= $row->tutor_tesis?></td>
		<td><?= $row->fecha_tesis?></td>
		<td><?= $row->universidad?></td>
		<td><a href= "<?= Url::toRoute(["site/actualizartesis", "id_tesis" => $row->id_tesis]) ?>">Editar</a></td>
		<td>
            <a href="#" data-toggle="modal" data-target="#id_tesis_<?= $row->id_tesis ?>">Eliminar</a>
            <div class="modal fade" role="dialog" aria-hidden="true" id="id_tesis_<?= $row->id_tesis ?>">
                      <div class="modal-dialog">
                            <div class="modal-content">
                              <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                                    <h4 class="modal-title">Eliminar Tesis</h4>
                              </div>
                              <div class="modal-body">
                                    <p>¿Realmente deseas eliminar la tesis con ID <?= $row->id_tesis ?>?</p>
                              </div>
                              <div class="modal-footer">
                              <?= Html::beginForm(Url::toRoute("site/eliminartesis"), "POST") ?>
                                    <input type="hidden" name="id_tesis" value="<?= $row->id_tesis ?>">
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
