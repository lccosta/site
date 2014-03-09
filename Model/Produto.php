<?php

class Produto extends Prototype{
    
    public $id;
    public $nome;
    public $valor;
    public $quantidade;

    public function exchangeArray(array $data) {
        $this->id = isset($data['id']) ? $data['id'] : NULL;
        $this->nome = isset($data['nome']) ? $data['nome'] : NULL;
        $this->valor = isset($data['valor']) ? $data['valor'] : NULL;
        $this->quantidade = isset($data['quantidade']) ? $data['quantidade'] : NULL;
    }
    
}

?>
