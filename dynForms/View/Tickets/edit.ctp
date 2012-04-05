<div class="posts form">
<?php echo $this->Form->create('DynamicFormResponse' , array( 'type' => 'put' ));?>
    <fieldset>
        <legend><?php __('Update Ticket');?></legend>
    <?php
        echo $this->Form->hidden('_id');
        echo $this->Form->input('status');
        echo $this->Form->input('escalation');
        echo $this->Form->input('priority');
        echo $this->Form->input('department_id');
    ?>
    </fieldset>
<?php echo $this->Form->end('Submit');?>
</div>