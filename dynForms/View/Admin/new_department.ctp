<?php $this->extend('/Admin/index'); 
    $this->start('admin_content');
?>
<?php if(isset($Department_already_exists) == true): ?>
    <div class="alert alert-block alert-error">
        <a class="close" data-dismiss="alert">×</a>
        <strong>Error !</strong> Department already exists.
    </div>
<?php endif; ?>
<style>
    #NewDepartmentFormContainer input{
        font-size:20px;
        height:60px;
    }
    #NewDepartmentFormContainer select{
        font-size:20px;
        height:60px;
    }
    #NewDepartmentFormContainer label{
        font-size:20px;
        margin:5px;
    }
    #NewDepartmentFormContainer div textarea{
        font-size:15px;
        
    }
</style>
<div id="NewDepartmentFormContainer">
<?php echo $this->Form->create("Department"); ?>
<legend>Create a new Department </legend>
<?php 
    echo $this->Form->input("name",array(
                            "class"=>"span10",
                            "placeholder"=>"Name of the new department"
                            ));
    echo $this->Form->input("description",array(
                            "type"=>"textarea",
                            "class"=>"span10",
                            "placeholder"=>"A few words about the department"
                            ));
    echo $this->Form->submit("Add Department",array("class"=>"btn btn-primary span10"));

    echo $this->Form->end();

 ?>
</div>
<?php $this->end(); ?>