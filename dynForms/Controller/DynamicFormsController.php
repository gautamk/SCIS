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
    
    public function _csrf_error() {
        $this->flash("csrf Error", array("controller" => "Pages", "action" => "display"));
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

    public function index() {
        
    }
    
    /**
     * Check if valid and retrieve a dynamic form
     * from the database
     * @name
     * @param type $id 
     */
    public function getForm($id=null){
        $result = $this->DynamicForm->isValidForm($id);
        if($result == false){
            $this->flash("Invalid form", $this->referer(
                    array('controller'=>"pages", 'action' => 'index')
                    ));
            return;
        }
        /**
         *@var Dynamic form configuration obtained from Mongodb
         */
        $result["DynamicForm"]["options"]["url"]=array("controller"=>"dynamicforms","action"=>"formresponse");
        $this->set("dynamicForm",$result["DynamicForm"]);
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
    
    
    /**
     *
     * @param type $id 
     */    
    public function formResponse($id) {
        
    }

}

