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

}

