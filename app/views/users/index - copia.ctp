<h2>Usuarios del Sistema</h2>
<?php if(empty($users)): ?>
No hay usuarios en esta lista
<br>
<br>
<?php else: ?>
<table>
<tr>
<th>Nombre</th>
<th>Acciones</th>
</tr>
<?php foreach ($users as $usr): ?>
<tr>
<td>
<?php echo $usr['Usuario']['nombre'] ?>
</td>
<td>
<?php echo $html->link('Editar', array('action'=>'edit',$usr['Usuario']['id']));?>&nbsp

<?php echo $html->link('Borrar', array('action'=>'delete',
 $usr['Usuario']['id']), null, '¿Estás Seguro?'); ?>
</td>
</tr>
<?php endforeach; ?>
</table>
<?php endif; ?>
<?php echo $html->link("Agregar Usuario", array("action"=>"add")); ?>