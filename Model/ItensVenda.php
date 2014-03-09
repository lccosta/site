<?php

class ItensVenda extends Prototype{
    
    public $id;
    public $produto;
    public $quantidade;
    public $valor_unitario;

    public function exchangeArray(array $data) {
        $this->id = isset($data['id']) ? $data['id'] : NULL;
        $this->produto->id = isset($data['prod_id']) ? $data['prod_id'] : NULL;
        $this->produto->nome = isset($data['prod_nome']) ? $data['prod_nome'] : NULL;
        $this->produto->valor = isset($data['prod_valor']) ? $data['prod_valor'] : NULL;
        $this->produto->quantidade = isset($data['prod_quantidade']) ? $data['prod_quantidade'] : NULL;
        $this->quantidade = isset($data['quantidade']) ? $data['quantidade'] : NULL;
        $this->valor_unitario = isset($data['valor_unitario']) ? $data['valor_unitario'] : NULL;
    }
    
}

?>
