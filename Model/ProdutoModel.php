<?php

class ProdutoModel extends Model{

    protected function setPrototype() {
        $this->prototype = new Produto;
        $this->table = 'produto';
    }
    
    public function getProdutos(){
        $produtos = $this->ready();
        return $produtos;
    }

}

?>
