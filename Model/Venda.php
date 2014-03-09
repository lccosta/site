<?php

class Venda extends Prototype{
    
    public $id;
    public $cliente;
    public $itens = array();

    public function exchangeArray(array $data) {
        $this->id = isset($data['id']) ? $data['id'] : NULL;
        $this->cliente = new Cliente();
        $this->cliente->id = isset($data['cli_id']) ? $data['cli_id'] : NULL;
        $this->cliente->nome = isset($data['cli_nome']) ? $data['cli_nome'] : NULL;
    }

}

?>
