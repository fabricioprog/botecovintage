<?php 
class Conta_model extends CI_Model{

    public function __construct() {		
        parent::__construct();
	}

    public function get_mesas_status(){
        $sql = "select cd_mesa, ci_conta codigo, cd_status status from tb_conta c
                where cd_status in (2,3,4)";
        return $this->db->query($sql)->result();        
    }

    public function add_conta($cd_mesa,$cd_status,$dt_abrir){        
        $sql = "INSERT INTO tb_conta values (default,?,?,?,null,0)";        
        $this->db->query($sql,array($cd_mesa,$cd_status,$dt_abrir));
    }

    

}

?>