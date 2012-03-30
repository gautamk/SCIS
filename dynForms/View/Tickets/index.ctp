<?php debug($tickets); ?>
<table>
<?php foreach ($tickets as $key => $ticket): ?>
	<tr>
		<td>
			<?php echo $ticket['DynamicFormResponse']['email']; ?>
		</td>
		<td>
			<?php echo $ticket['DynamicFormResponse']['brief_description']; ?>
		</td>
		<td>
			<?php 
				echo $ticket['DynamicFormResponse']['contact_from']['hour'],
				":",$ticket['DynamicFormResponse']['contact_from']['hour']; 
			?>
		</td>
		<td>
			<?php
				echo $this->Html->link("Created",array(),array(),
					date('Y-M-d h:i:s',
						$ticket['DynamicFormResponse']['created']->sec )
				);
				echo $this->Html->link("Modified",array(),array(),
					date('Y-M-d h:i:s',
						$ticket['DynamicFormResponse']['modified']->sec )
				);
			 ?>
			
		</td>
		<td>
			<?php echo $ticket['DynamicFormResponse']['status']; ?>
		</td>
		<td>
			<?php echo $this->Html->link("Source Form",
				array(
					"controller"=>"dynamicForms",
					"action"=>"getForm",
					$ticket['DynamicFormResponse']['dynamicForm_id']
				),
				array( 'target' => '_blank')
			); ?>
		</td>
	</tr>
<?php endforeach ?>
</table>