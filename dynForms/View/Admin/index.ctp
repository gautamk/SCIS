<div style="padding:5px;" class="btn-group">
<?php 
    echo $this->Html->link("New User",array(
            "controller"=>"admin","action"=>"new_user"
            ),array("class"=>"btn btn-large btn-success"));

    echo $this->Html->link("List Users",array(
            "controller"=>"admin","action"=>"list_users"
            ),array("class"=>"btn btn-large btn-info"));
?>
</div>
<div style="padding:5px;" class="btn-group">
<?php 

    echo $this->Html->link("New Department",array(
            "controller"=>"admin","action"=>"new_department"
            ),array("class"=>"btn btn-large btn-success"));


    echo $this->Html->link("List Departments",array(
            "controller"=>"admin","action"=>"list_departments"
            ),array("class"=>"btn btn-large btn-info"));
?>
</div>
<?php echo $this->fetch('admin_content'); ?>