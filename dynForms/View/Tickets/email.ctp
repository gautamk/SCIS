<a class="btn btn-large btn-primary" href="<?php echo Router::url(array("controller"=>"tickets","action"=>"index")) ?>">
    Index
</a>
    <?php 
        echo $this->Form->create("email",array(
                "class"=>"hero-unit "
             ));
        $common_class = "span10";
        echo  $email==false?
                $this->Form->input("to",array(
                   "type"=>"email",
                   "class"=>"$common_class",
               )) 
                :
                $this->Form->input("to",array(
                    "type"=>"email",
                    "value"=>"$email",
                    "readonly"=>"readonly",
                    "class"=>"$common_class",
                ));
        echo $this->Form->input("subject",array(
                "type"=>"text",
                "value"=>"Regarding Your Issue : $id",
                "class"=>"$common_class",
            ));
        echo $this->Form->input("message",array(
                "type"=>"textarea",
                "class"=>"$common_class",
        ));

        echo $this->Form->submit("Send",array(
                "class"=>"btn btn-primary btn-large"
            ));
        echo $this->Form->end();

    ?>

