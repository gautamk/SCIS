<?php
class AdminController extends AppController{
    public $helpers = array('Form', 'Html');

    public function new_user(){
        if($this->request->is("Post")){
            $this->loadModel("User");
            try{
                $this->User->create();
                $this->User->save($this->request->data);
            }
            catch(MongoCursorException $e){
                if ($e->getCode() == 11000){
                    $this->set("user_already_exists",true);
                }
            }
        }
    }
}