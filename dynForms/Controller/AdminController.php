<?php
class AdminController extends AppController{
    public $helpers = array('Form', 'Html');

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
}