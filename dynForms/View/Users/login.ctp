
<div style="display:block;text-align:center;" class="users form">
<?php echo $this->Session->flash('auth'); ?>
<?php echo $this->Form->create('User');?>
    <fieldset>
        <legend><?php echo __('Please enter your email and password'); ?></legend>
    <?php
        echo $this->Form->input('email');
        echo $this->Form->input('password');
    ?>
    </fieldset>
<?php 
    echo $this->Form->submit('Login',array("class"=>"btn btn-primary"));
    echo $this->Form->end();
?>
</div>