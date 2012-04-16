
<style>
    #emailEmailForm{
        border:7px solid;
        border-radius:15px;
        border-top-left-radius: 15em 1em;
        border-bottom-right-radius: 15em 1em;
    }
</style>
<div id="FormContainer" class="span10">
<a class="btn btn-large btn-primary" href="<?php echo Router::url(array("controller"=>"tickets","action"=>"index")) ?>">
    Index
</a>
    <?php 
        echo $this->Form->create("email",array(
                "class"=>"hero-unit "
             ));
    ?>
    <h1>Send Email</h1>
    <?php
        $common_class = "span8";
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
                "class"=>"btn btn-primary ".$common_class
            ));
        echo $this->Form->end();

    ?>
</div><!-- /FormContainer -->