<style type="text/css" >
    #EditFormContainer{
        display: block;
        width:500px;
        margin:0 auto;
        text-align:center;
        border:7px solid;
        border-radius:15px;
        border-top-left-radius: 15em 1em;
        border-bottom-right-radius: 15em 1em;
        padding: 10px;

    }
</style>
<div class="posts form" id="EditFormContainer">
<?php echo $this->Form->create('DynamicFormResponse' , array( 'type' => 'put' ));?>
    <fieldset>
        <legend><?php echo 'Update Ticket';?></legend>
    <?php
        echo $this->Form->hidden('_id');
        echo $this->Form->input('status');
        echo $this->Form->input('escalation');
        echo $this->Form->input('priority');
        echo $this->Form->input('department_id',array("type"=>"text"));
    ?>
    </fieldset>
    <?php echo $this->Form->submit("Save",array("class"=>"btn btn-primary btn-large")); ?>
    <?php echo $this->Html->link("Cancel",array("action"=>"index"),array("class"=>"btn btn-small btn-danger")); ?>
<?php echo $this->Form->end();?>
</div>