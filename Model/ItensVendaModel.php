<?php

class ItensVendaModel extends Model{
    
    protected function setPrototype() {
        $this->prototype = new ItensVenda();
        $this->table = 'itens_venda';
    }
    
    public function save(ItensVenda $item){
        $this->create(array(
            'id' => $item->id,
            'produto' => $item->produto,
            'quantidade' => $item->quantidade,
            'valor_unitario' => $item->valor_unitario
        ));
    }
}

?>
