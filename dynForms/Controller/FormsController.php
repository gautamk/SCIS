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
    
    
   
    
    public function _crsf_error(){
        $this->flash("CRSF Error", array("controller"=>"Pages","action"=>"display"));
    }

    public function blackhole($type) {
        switch ($type) {
            case 'csrf':
                $this->_crsf_error();
                break;

            default:
                break;
        }
    }
    
    public function beforeFilter() {
        $this->Security->blackHoleCallback = 'blackhole';
    }
    
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
    
    public function form_response() {
        
    }
    
}

