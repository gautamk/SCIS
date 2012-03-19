<?php
echo $this->Form->create(
        $dynamicForm["model"],
        $dynamicForm["options"]
        );
foreach ($dynamicForm["inputs"] as $input => $options) {
    echo $this->Form->input($input,$options);    
}
echo $this->Form->submit($dynamicForm['submit']);
echo $this->Form->end();

debug($dynamicForm);
?>
