<?php

class Cliente extends Prototype{
    
    public $id;
    public $nome;

    public function exchangeArray(array $data) {
        $this->id = isset($data['id']) ? $data['id'] : NULL;
        $this->nome = isset($data['nome']) ? $data['nome'] : NULL;
    }

}

?>
