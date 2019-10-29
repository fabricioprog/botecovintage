<?php 
class Despesa_model extends CI_Model{

    public function __construct() {		
        parent::__construct();
    }
    
    public function get_despesas($cd_categoria,$dt_despesa){
        $sql = "SELECT * FROM tb_despesa";
        //$this->db->query($sql,array($cd_categoria,$dt_despesa));
    }

    public function add_despesa($cd_categoria,$dt_despesa,$ds_descricao,$nr_valor){
        $sql = "INSERT INTO tb_despesa values(default,?,?,?,?)";
        $this->db->query($sql,array($cd_categoria,$dt_despesa,$ds_descricao,$nr_valor));
    }
    

}

?>