<h2>Directores</h2>
<?php if(empty($directors)): ?>
No hay directores en esta lista
<br>
<br>
<?php else: ?>
<table>
<tr>
<th>Apellido</th>
<th>Nombre</th>
<th>Nacionalidad</th>
<th>Acciones</th>
</tr>
<?php foreach ($directors as $dirs): ?>
<tr>
<td>
<?php echo $dirs['Director']['apellido'] ?>
</td>
<td>
<?php echo $dirs['Director']['nombre'] ?>
</td>
<td>
<?php echo $dirs['Director']['pepe_id'] ?>
</td>
<td class="actions">
<?php echo $html->link(__('Editar', true), array('action'=>'edit',$dirs['Director']['id']));?>&nbsp

<?php echo $html->link('Borrar', array('action'=>'delete',
 $dirs['Director']['id']), null, '¿Estás Seguro?'); ?>
</td>
</tr>
<?php endforeach; ?>
</table>
<?php endif; ?>
<div>
<table cellpadding="0" cellspacing="0">
<td class="actions">
<?php echo $html->link(__('Agregar Director', true), array('action'=>'add')); ?>&nbsp
</td>
</table></div>