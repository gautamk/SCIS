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
    
    
   
    
    public function _csrf_error(){
        $this->flash("CRSF Error", array("controller"=>"Pages","action"=>"display"));
    }

    public function blackhole($type) {
        switch ($type) {
            case 'csrf':
                $this->_csrf_error();
                break;

            default:
                break;
        }
    }
    
    public function beforeFilter() {
        $this->Security->blackHoleCallback = 'blackhole';
    }
    
    public $helpers=array("Form","Html");
    
    
    
    /**
     * This method can be used to check if a form is valid
     * 
     * A form is valid if a configuration corresponding to the id is 
     * present in the mongodb database.
     * 
     * @param type $id 
     * @return boolean if form is not valid
     * @return mixed if form is valid (the form data from the database).
     */
    protected function _isValidForm($id=null){
        if(is_null($id) == true){
            return false;
        }
        $results = $this->Form->read(null,$id);
        if ($results==null){
            return false;
        }
        return $results;
    }
    
    /**
     * This method is called by getForm action when 
     * HTTP GET method is used
     * @param type $id
     * @return type 
     */
    protected function _getForm_GET($id=null){
        
        $formValidity = $this->_isValidForm($id);
        
        if($formValidity == false){
            $this->flash("Invalid Form", array("controller"=>"Pages","action"=>"display"));
            return;
        }
        
        $results = $formValidity;
        $this->Form->setValidationRules($results['Form']['validation']);
        $this->set("form", $results);
        $this->render('/Forms/getform');
        
    }
    
    
    
    protected function _getForm_POST($id=null){
        $formValidity = $this->_isValidForm($id);
        if($formValidity == false){
            $this->flash("Invalid Form", array("controller"=>"Pages","action"=>"display"));
            return;
        }
        $results = $formValidity;
        $this->Form->setValidationRules($results["Form"]["validation"]);
        $this->Form->set($this->request->data);
        if($this->Form->validates() == true){
            $this->flash("Valid Details", "");
            return;
        } else {
            print_r($this->Form->validationErrors);
            die();
        }
        
    }
    
    public function getForm($id=null){
        if($this->request->is("get")){
            $this->_getForm_GET($id);
            return;
        }else if($this->request->is("post")){
            $this->_getForm_POST($id);
            return;
        }
    }
    
    
    
    
    
}

