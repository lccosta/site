<?php

class ClienteController extends Controller{
    
    public function init() {
        
    }
    
    public function index(){
        $clienteModel = new ClienteModel();
        $this->view->clientes = $clienteModel->getClientes();        
        $this->initView('cliente/index');
    }
}

?>
