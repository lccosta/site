<?php

abstract class Model {
     
    protected $conn;
    protected $db;
    protected $prototype;
    protected $table;
    protected $query;

    abstract protected function setPrototype();
    
    public function __construct() {
        $this->setPrototype();
    }
    
    protected function conectaBanco(){
        if (!$this->conn){
            $this->conn = mysql_connect('127.0.0.1', 'root');
            if (!$this->conn){
                throw new Exception('Não foi possível conectar-se ao servidor');
            }
            
            $this->db = mysql_select_db('lcorreia', $this->conn);
        }
        
        return $this->conn;
    }
    
    protected function create(Array $data){
        if (count($data) == 0){
            throw new Exception('Para inserção informe um array do tipo chave e valor no parâmetro data');
            return FALSE;
        }
        
        $colunas = array();
        $valores = array();
        foreach ($data as $key => $value) {
            $colunas[] = $key;
            $valores[] = addslashes($value);
        }
        
        $this->query = "insert into ".$this->table."(".implode(",", $colunas).") values('".implode("','", $valores)."')";
        return $this->executaSQL();
    }

    protected function ready(Array $columns = array(), Array $where = array()){
        $colunas = array();
        foreach ($columns as $key => $value) {
            $colunas[] = is_int($key) ? $value : $key." as ".$value;
        }
        
        $condicoes = array();
        foreach ($condicoes as $key => $value) {
            $condicoes[] = $key." = '".addslashes($value)."'";
        }

        $this->query = "select ".(count($colunas) > 0 ? implode(", ", $colunas) : "*")." from ".$this->table;
        $this->query .= count($where) > 0 ? " where ".implode(" and ", $condicoes) : '';
        
        return $this->executaSelectPrototype();
    }
    
    protected function update(Array $data, Array $where = array()){        
        if (count($data) == 0){
            throw new Exception('Para alteração informe um array do tipo chave e valor no parâmetro data');
        }
        
        $hashes = array();
        foreach ($data as $key => $value) {
            $hashes[] = $key." = '".addslashes($value)."'";
        }
        
        $condicoes = array();
        foreach ($condicoes as $key => $value) {
            $condicoes[] = $key." = '".addslashes($value)."'";
        }
        
        $this->query = "update ".$this->table." set ";
        $this->query .= implode(",", $hashes);
        $this->query .= count($where) > 0 ? " where ".implode(" and ", $condicoes) : '';
        return $this->executaSQL();
    }
    
    protected function delete(Array $where = array()){        
        $condicoes = array();
        foreach ($condicoes as $key => $value) {
            $condicoes[] = $key." = '".addslashes($value)."'";
        }
        
        $this->query .= count($where) > 0 ? " where ".implode(" and ", $condicoes) : '';
        return $this->executaSQL();
    }
    
    protected function beginTransaction(){
        $this->query = "SET AUTOCOMMIT=0";
        $this->executaSQL();

        $this->query = "START TRANSACTION";
        $this->executaSQL();
    }
    
    protected function commit(){
        $this->query = "COMMIT";
        $this->executaSQL();

        $this->query = "SET AUTOCOMMIT=1";
        $this->executaSQL();        
    }
    
    protected function rollBack(){
        $this->query = "ROLLBACK";
        $this->executaSQL();

        $this->query = "SET AUTOCOMMIT=1";
        $this->executaSQL();        
    }

    protected function getLastInsertValue($column_name_id){
        $this->query = "select max(".$column_name_id.") as id from ".$this->table;
        $dados = $this->executaSelect();
        if (count($dados) == 0 || $dados === FALSE){
            return NULL;
        }
        
        return $dados[0]['id'];
    }

    protected function executaSQL(){
        $rs = mysql_query($this->query, $this->conectaBanco());
        if (!$rs){
            throw new Exception('Não foi possível executar a consulta sql');
            return FALSE;
        }
        
        return TRUE;
    }
    
    protected function executaSelect(){
        $rs = mysql_query($this->query, $this->conectaBanco());
        if (!$rs){
            throw new Exception('Não foi possível executar a consulta sql');
            return FALSE;
        }
        
        $dados = array();
        while ($row = mysql_fetch_array($rs)){
            $dados[] = $row;
        }
        
        return $dados;
    }
    
    protected function executaSelectObject(){
        $rs = mysql_query($this->query, $this->conectaBanco());
        if (!$rs){
            throw new Exception('Não foi possível executar a consulta sql');
        }
        
        $dados = array();
        while ($row = mysql_fetch_array($rs)){
            $object = new stdClass();
            $adiciona = FALSE;
            foreach ($row as $key => $value) {
                if ($adiciona){
                    $object->$key = $value;
                }
                
                $adiciona = !$adiciona;
            }
            $dados[] = $object;
        }
        
        return $dados;
    }
    
    protected function executaSelectPrototype() {
        $rs = mysql_query($this->query, $this->conectaBanco());
        if (!$rs){
            throw new Exception('Não foi possível executar a consulta sql');
        }
        
        $dados = array();
        while ($row = mysql_fetch_array($rs)){
            $object = clone $this->prototype;            
            $object->exchangeArray($row);            
            $dados[] = $object;
        }
               
        return $dados;
    }
}
