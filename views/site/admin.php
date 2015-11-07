<?php
use yii\helpers\Url;
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\data\Pagination;
use yii\widgets\LinkPager;
?>



<?php $f = ActiveForm::begin([
		"method" => "get",
		"action" => Url::toRoute("site/admin"),
		"enableClientValidation" => true,
]);
?>

<div class="form-group">
	<center><?= $f->field($form, "q")->input("buscar")?></center> 
</div>

<center><?= Html::submitButton("Buscar", ["class" => "btn btn-primary"])?></center>

<?php $f->end() ?>

<h3><?= $search ?></h3>

<center><h3>Control de Usuarios</h3></center>
<table class= " table table-striped">
	<tr>
	
		<th> ID Usuario</th>
		<th>Usuario</th>
		<th>Email</th>
		<th>Nombre</th>
		<th>Apellido</th>
		<th>Nacionalidad</th>
		<th>Rol</th>
		<th></th>
		<th></th>
		
	</tr>
	<?php foreach ($model as $row): ?>
	<tr>
		<td><?= $row->id?></td>
		<td><?= $row->usuario?></td>
		<td><?= $row->email?></td>
		<td><?= $row->nombre?></td>
		<td><?= $row->apellido?></td>
		<td><?= $row->nacionalidad?></td>
		<td><?= $row->rol?></td>		
		<td><a href= "<?= Url::toRoute(["site/actualizarusuario", "id" => $row->id]) ?>"><?= Html::submitButton("Editar", ["class" => "btn btn-warning"])?></a></td>
		<td>
            <a href="#" data-toggle="modal" data-target="#id<?= $row->id ?>"><?= Html::submitButton("Eliminar", ["class" => "btn btn-danger"])?></a>
            <div class="modal fade" role="dialog" aria-hidden="true" id="id<?= $row->id ?>">
                      <div class="modal-dialog">
                            <div class="modal-content">
                              <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                                    <h4 class="modal-title">Eliminar Usuario</h4>
                              </div>
                              <div class="modal-body">
                                    <p>Realmente deseas eliminar el Usuario con ID <?= $row->id ?>?</p>
                              </div>
                              <div class="modal-footer">
                              <?= Html::beginForm(Url::toRoute("site/eliminarusuario"), "POST") ?>
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
