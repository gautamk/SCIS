<?php $this->extend('/Admin/index'); 
    $this->start('admin_content');
?>
<style>
    #NewUserFormContainer input{
        font-size:20px;
        height:60px;
    }
    #NewUserFormContainer select{
        font-size:20px;
        height:60px;
    }
    #NewUserFormContainer label{
        font-size:20px;
        margin:5px;
    }
    #NewUserFormContainer div.input{
        
    }
</style>
<div id="NewUserFormContainer" class="span10">
    <?php if(isset($user_already_exists) == true): ?>
    <div class="alert alert-block alert-error">
        <a class="close" data-dismiss="alert">×</a>
        <strong>Error !</strong> User already exists.
    </div>
    <?php endif; ?>
    <?php 
    echo $this->Form->create("User");
    ?>
    <legend>Create a new User account</legend>
    <?php
        echo $this->Form->input("email",array("type"=>"email", "class"=>"span10",
                                "placeholder"=>"Enter the new users's email id ",
        ));

        echo $this->Form->input("password",array("type"=>"password","class"=>"span10",
                                "placeholder"=>"Enter the new users's password ",
        ));

        echo $this->Form->input("escalation",array(
                                "options"=>Configure::read("scis.ticket.escalation.options"),
                                "class"=>"span10",
        ));

        echo $this->Form->submit("Add User",array("class"=>"btn btn-primary span10"
        ));

        echo $this->Form->end();
    ?>
<div>
<?php $this->end(); ?>