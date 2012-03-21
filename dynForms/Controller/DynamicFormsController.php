<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of DynamicFormsController
 *
 * @author gautam
 */
class DynamicFormsController extends AppController {
    
    public $helpers=array('Form','Html');
    
    /**
     * Contains the form schema retrieved from the database
     * 
     * @var array 
     */
    private $form_schema = null;
    public function _csrf_error() {
        $this->flash("csrf Error",  $this->referer(
                array('controller'=>"pages", 'action' => 'display')
                    ));
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
        $this->loadModel('DynamicFormResponse');
    }

    public function index() {
        
    }
    
    
    /**
     * Check if valid and retrieve a dynamic form
     * from the database
     * @name
     * @param type $id 
     */
    public function getForm($id=null){
        /**
         *  Check if form exists 
         */
        $this->form_schema= $this->DynamicForm->isValidForm($id);
        
        if($this->form_schema == false){
            $this->flash("Invalid form", $this->referer(
                    array('controller'=>"pages", 'action' => 'display')
                    ));
            return;
            
        }
        
        $this->form_schema["DynamicForm"]["model"]="DynamicFormResponse";
        $this->DynamicFormResponse->validate = $this->form_schema['DynamicForm']["validation"];
        
        /**
         * Process Form submission 
         */
        if($this->request->is("POST")==true){
            /**
             * Data Validation 
             */
            if($this->DynamicFormResponse->save($this->request->data) == true ){
                $this->flash("Validation success",$this->referer(
                    array('controller'=>"pages", 'action' => 'display')
                    ));
                return;
            }
        }        
        
        $this->set("dynamicForm",$this->form_schema["DynamicForm"]);
        $this->render('get_form');
    }
   
    /**
     *  Alias action for getForm
     *  Use for convienience 
     * @see getForm
     * @param type $id 
     */
    public function gf($id=null) {
         //$this->redirect(array('action' => 'getForm',$id));
         $this->getForm($id);
         return;
    }
}
    
   