<?php
    error_reporting(E_STRICT);
    
    function __autoload($class_name){
        if (file_exists('Model/'.$class_name.'.php')){
            require_once 'Model/'.$class_name.'.php';
        }
        
        if (file_exists('Controller/'.$class_name.'.php')){
            require_once 'Controller/'.$class_name.'.php';
        }
    }
    
    $controller = isset($_GET['controller']) ? $_GET['controller'] : 'index';
    $controller = strtoupper(substr($controller, 0, 1)).substr($controller, 1).'Controller';
    $action = isset($_GET['action']) ? $_GET['action'] : 'index';        
    
    if (!file_exists('Controller/'.$controller.'.php')){
        echo 'O controlador '.$controller.' não foi criado';
        exit();
    }
        
    $controller = new $controller();
    
    if (!method_exists($controller, $action)){
        echo 'A ação '.$action.' não foi criada';
        exit();
    }
    
    $controller->init();
    $controller->$action();
?>