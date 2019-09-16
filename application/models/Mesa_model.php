<?php 
class Mesa_model extends CI_Model{

    public function __construct() {		
        parent::__construct();
	}

    public function is_mesa_livre($ci_mesa){
        $sql = "SELECT * FROM public.tb_conta c
        inner join public.tb_status s on s.ci_status = c.cd_status
        where cd_mesa = ? and c.cd_status IN (2,3,4)";
        $res =  $this->db->query($sql,array($ci_mesa))->row();
        if(empty($res)){
            return true;
        }else{
            return $res;
        }
    }
    

}

?>