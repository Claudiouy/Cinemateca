<div class="index">
	<h2 id="h2"><?php __('Suscripciones');?></h2>
        <table cellpadding="0" cellspacing="0" style="width:80%">
            <tr>
                            <th><?php echo $this->Paginator->sort('id');?></th>
                            <th><?php echo $this->Paginator->sort('name');?></th>
                            <th><?php echo $this->Paginator->sort('description');?></th>
                            <th class="actions"><?php __('Acciones');?></th>
            </tr>
            <?php
            $i = 0;
            foreach ($suscriptions as $susc):
                    $class = null;
                    if ($i++ % 2 == 0) {
                            $class = ' class="altrow"';
                    }
            ?>
            <tr<?php echo $class;?>>
                    <td><?php echo $susc['Suscription']['id']; ?>&nbsp;</td>
                    <td class="longData"><?php echo $susc['Suscription']['name']; ?>&nbsp;</td>
                    <td class="longData"><?php echo $susc['Suscription']['description']; ?> &nbsp;</td>

                    <td class="actions">
                            <?php echo $this->Html->link(__('Editar', true), array('action' => 'edit_suscription', $susc['Suscription']['id'])); ?>
                            <?php echo $this->Html->link(__('Borrar', true), array('action' => 'remove_suscription', $susc['Suscription']['id']), null, sprintf(__('Esta Seguro de eliminar la suscripción N° %s?', true), $susc['Suscription']['id'])); ?>
                    </td>
            </tr>
                <?php endforeach; ?>
	</table>
	

	
</div>
<div class="actions">
	<h3><?php __('Acciones'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Nueva suscripción', true), array('action' => 'new_suscription')); ?></li>
	</ul>
</div>

<div style="margin-left:45%;"><p>
<div class="paging">
	<?php echo $paginator->prev('<< '.__('previa', true), array(), null, array('class'=>'disabled'));?>
 | 	<?php echo $paginator->numbers();?>
	<?php echo $paginator->next(__('siguiente', true).' >>', array(), null, array('class' => 'disabled'));?>
</div>
</p>
</div>	
