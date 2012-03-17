<?php

echo $this->Form->create($form["Form"]["name"],$form["Form"]["options"]);
echo $this->Form->hidden("form_id",array("value"=>$form["Form"]["_id"]));
foreach ($form["Form"]["inputs"] as $input => $options) {
    echo $this->Form->input($input,$options);    
}
echo $this->Form->submit($form["Form"]["submit"]);
echo $this->Form->end();
?>
<?php if(Configure::read("debug")>0): ?>
<pre>
    <?php
        print_r($form);
    ?>
</pre>
<?php endif; ?>


