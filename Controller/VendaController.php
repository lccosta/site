<?php

class VendaController extends Controller{

    public function init() {
        
    }
    
    public function index() {
        $vendaModel = new VendaModel();
        $this->view->vendas = $vendaModel->getVendas();        
        $this->initView('venda/index');
    }
    
    public function create(){
        $clienteModel = new ClienteModel;        
        $this->view->clientes = $clienteModel->getClientes();
        
        $produtoModel = new ProdutoModel();
        $this->view->produtos = $produtoModel->getProdutos();
        
        if (count($_POST) > 0){
            $venda = new Venda();
            $venda->exchangeArray($_POST);
            
            foreach ($_POST['prod_id'] as $key => $value){
                $item = new ItensVenda();
                $item->produto = $value;
                $item->quantidade = $_POST['quantidade'][$key];
                $item->valor_unitario = $_POST['valor_unitario'][$key];
                $venda->itens[] = $item;
            }
            
            $vendaModel = new VendaModel();
            $vendaModel->save($venda);
        }
        
        $this->initView('venda/create');
    }
    
}

?>
