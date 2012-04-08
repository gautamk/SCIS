<style type="text/css" >
    #LoginFormContainer{
        display: block;
        width:500px;
        margin:0 auto;
        text-align:center;
        border:7px solid;
        border-radius:15px;
        border-top-left-radius: 15em 1em;
        border-bottom-right-radius: 15em 1em;
        padding: 10px;

    }
</style>

<div id="LoginFormContainer" >
    <?php echo $this->Session->flash('auth'); ?>
    <?php echo $this->Form->create('User',array("class"=>""));?>
        <fieldset>
            <legend><h1>SCIS Staff</h1></legend>
        <?php
            echo $this->Form->input('email',array(
                                    "label"=>"",
                                    "class"=>"span5",
                                    "placeholder"=>"Email address"));
            echo $this->Form->input('password',array(
                                    "label"=>"",
                                    "class"=>"span5",
                                    "placeholder"=>"Password"));
        ?>
        </fieldset>
    <?php 
        echo $this->Form->submit('Login',array("class"=>"btn btn-large btn-primary"));
        echo $this->Form->end();
    ?>
</div>