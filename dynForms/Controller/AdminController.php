<?php
class AdminController extends AppController{
    public $helpers = array('Form', 'Html');

    public function beforeFilter(){
            if($this->Auth->loggedIn()){
                $email = $this->Auth->user("email");
            $result = $this->Acl->check("Admin/$email","Administration");
            if($result != true){
                throw new ForbiddenException("Access Denied");
                
            }
        }

    }
    public function index(){

    }
    public function new_user(){
        if($this->request->is("Post")){
            $this->loadModel("User");
            try{
                $this->User->create();
                $result = $this->User->save($this->request->data);
                $this->flash("User successfully added",array());
            }
            catch(MongoCursorException $e){
                if ($e->getCode() == 11000){
                    $this->set("user_already_exists",true);
                }
            }
        }
    }

    public function list_users(){
        $this->loadModel("User");
        $result = $this->User->find("all",array(
                          "fields"=>array("_id","email","escalation")
        ));
        $this->set("users",$result);
    }

    public function new_department(){
        if($this->request->is("Post")){
            $this->loadModel("Department");
            try{
                $this->Department->create();
                $result = $this->Department->save($this->request->data);
                if($result){
                    $this->flash("Department successfully added",array());
                }
            }
            catch(MongoCursorException $e){
                if ($e->getCode() == 11000){
                    $this->set("Department_already_exists",true);
                }
            }
        }
    }

    public function list_departments(){
        $this->loadModel("Department");
        $result = $this->Department->find("all",array(
            "fields"=>array("_id","name","description")
        ));
        $this->set("departments",$result);
    }
}