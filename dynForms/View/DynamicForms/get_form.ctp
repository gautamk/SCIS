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
debug(env('HTTP_USER_AGENT'));
?>
