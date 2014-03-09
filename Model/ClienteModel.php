<?php

class ClienteModel extends Model{

    protected function setPrototype() {
        $this->prototype = new Cliente();
        $this->table = 'cliente';
    }
    
    public function getClientes(){
        $clientes = $this->ready();        
        return $clientes;
    }

}

?>
