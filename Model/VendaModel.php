<?php

class VendaModel extends Model{    

    protected function setPrototype() {
        $this->prototype = new Venda();
        $this->table = 'venda';
    }
    
    public function getVendas(){
        $this->query = "select vend.id as id, cli.id as cli_id, cli.nome as cli_nome 
            from venda vend inner join cliente cli on (vend.cliente = cli.id)";
        $vendas = $this->executaSelectObject();
        return $vendas;
    }
    
    public function save(Venda $venda){
        $itemVendaModel = new ItensVendaModel();
        
        $data = array(
            'cliente' => $venda->cliente->id
        );
        
        $this->beginTransaction();
        
        if ($venda->id == NULL){                
            $this->create($data);
            $id = $this->getLastInsertValue('id');
        } else {
            $id = $venda->id;
            $itemVendaModel->delete(array('id' => $venda->id));
        }
                
        foreach ($venda->itens as $item){
            $item->id = $id;
            $itemVendaModel->save($item);
        }
        
        $this->commit();
    }    
}

?>
