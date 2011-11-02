<div class="index">
	<h2><?php __('Pagos');?></h2>
	<table cellpadding="0" cellspacing="0">
	<tr>
			<th><?php echo $this->Paginator->sort('id');?></th>
			<th><?php echo $this->Paginator->sort('Detalle');?></th>
                        <th><?php echo $this->Paginator->sort('');?></th>
			<th class="actions"><?php __('Acciones');?></th>
	</tr>
	<?php
	$i = 0;
        if(!empty($allPayments)){
            foreach ($allPayments as $pay):
                    $class = null;
                    if ($i++ % 2 == 0) { 
                            $class = ' class="altrow"';
                    }
            ?>
            <tr<?php echo $class;?>>

                    <td><?php echo $pay['Payment']['id']; ?>&nbsp;</td>
                    <td><?php echo $this->Html->link(__('Ver detalle', true), array('action' => 'detail', $pay['Payment']['id'])); ?></td>
                    </td>
                    <td><?php  ?>&nbsp;</td>

                    <td class="actions">
                            
                    </td>
            </tr>
                <?php endforeach;}?>
	</table>
	

	
</div>
<div class="actions">
	<h3><?php __('Acciones'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Ingresar pago', true), array('action' => 'new_payment')); ?></li>
	</ul>
</div>
