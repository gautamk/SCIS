<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of FormsController
 * @package       app.Controller
 * @author gautam
 */
class FormsController extends AppController {
    public $helpers=array("Form","Html");
    public function getForm($id=null){
        if(is_null($id) == true ){
            $this->flash("Invalid Form", array("controller"=>"Pages","action"=>"display"));
        }
        
        $results = $this->Form->read(null,$id);
        if ($results==null){
            $this->flash("Invalid Form", array("controller"=>"Pages","action"=>"display"));
        }
//        echo "<pre>";
//        print_r($results);
//        echo "</pre>";
//        die();
        
        $this->set("form", $results);
    }
}

