<?php 

/**
 * Display Real time charts
 * @author Gautam
 */
class ChartsController extends AppController{
    public $components=array('RequestHandler');
    public $helpers = array('Form', 'Html');

    public function beforeFilter() {
        $this->loadModel('DynamicFormResponse');
    }

    protected function _ajax_only(){
        if(! $this->request->is('ajax') ){
            throw new NotFoundException();
        }
    }

    /**
     * Landing Page
     */
    public function index(){

    }
    /**
     * @param ConfigAttr A Configuration attribute ("priority","status","escalation")
     * @return an array containing the attribute and percentages of each
     */
    protected function _count_attributes($ConfigAttr=null){
        if(is_null($ConfigAttr)){
            return false;
        }
        $values = Configure::read("scis.ticket.$ConfigAttr.options");
        $count=array();
        $total=$this->DynamicFormResponse->find("count");
        foreach ($values as $key => $value) {
            $result = $this->DynamicFormResponse->find("count",array(
                    'conditions' => array("$ConfigAttr" => $key)
            ));
            $percent = ($result/$total) * 100;
            array_push($count, array($key,$percent));
        }
        return $count;
    }

    protected function _generate_highCharts_series($data=null,$type="pie",$name=""){
        return array(
                    "type"=>$type,
                    "name"=>$name,
                    "data"=>$data,
                );
    }

    public function priority(){
        $this->set("data",
            $this->_generate_highCharts_series(
                $this->_count_attributes('priority')
            )
        );
        $this->render("charts");
    }

    public function escalation(){
        $this->set("data",
            $this->_generate_highCharts_series(
                $this->_count_attributes('escalation')
            )
        );
        $this->render("charts");
    }

    public function status(){
        $this->set("data",
            $this->_generate_highCharts_series(
                $this->_count_attributes('status')
            )
        );
        $this->render("charts");
    }
}