<style type="text/css" media="screen">
    #DynamicForm input{
        width:100%
    }
    #DynamicForm textarea{
        width:100%
    }
</style>
<div id="DynamicForm" class="span10">
<?php
echo $this->Form->create(
        $dynamicForm["model"],
        $dynamicForm["options"]
        );
echo $this->Form->hidden("dynamicForm_id",array(
    "value"=>$dynamicForm["_id"]
));
//foreach ($dynamicForm["inputs"] as $input => $options) {
//    echo $this->Form->input($input,$options);    
//}
echo $this->Form->inputs($dynamicForm['inputs']);
echo $this->Form->submit($dynamicForm['submit']);
echo $this->Form->end();

debug($dynamicForm);

?>
</div>