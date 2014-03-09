<?php

abstract class Controller {
    
    protected $view;
    
    abstract public function init();
    abstract public function index();

    public function __construct() {
        $this->view = new stdClass();
    }

    protected function initView($pathView){
        $view = get_object_vars($this->view);
        foreach ($view as $key => $value){
            $this->$key = $value;
        }
        
        if (!file_exists('View/'.$pathView.'.php')){
            echo 'A visão '.$pathView.' não foi criada';
            exit();
        }
        
        include_once 'View/'.$pathView.'.php';
    }
}

?>
