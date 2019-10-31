<?php 
class Despesa_model extends CI_Model{

    public function __construct() {		
        parent::__construct();
    }
    
    public function get_despesas($dt_inicio,$dt_fim,$cd_categoria=false){
        $params = array($dt_inicio,$dt_fim);
        $where = "";
        if($cd_categoria){
            $params[] = $cd_categoria;
            $where = "and cd_categoria = ? ";
        }
        $sql = "SELECT d.*, c.nm_categoria,TO_CHAR(d.dt_despesa, 'DD/MM/YYYY') dt_despesa, d.valor::money valor_moeda FROM tb_despesa d
        inner join tb_categoria c on d.cd_categoria = c.ci_categoria
        where fl_deletado = false and dt_despesa between ? and ? $where ";
       return  $this->db->query($sql,$params)->result();
    }

    public function remover_despesa($id){
        $sql = "update tb_despesa set fl_deletado = true where ci_despesa = ?";
        $this->db->query($sql,array($id));
    }

    public function add_despesa($cd_categoria,$dt_despesa,$ds_descricao,$nr_valor){
        $sql = "INSERT INTO tb_despesa values(default,?,?,?,?)";
        $this->db->query($sql,array($cd_categoria,$dt_despesa,$ds_descricao,$nr_valor));
    }
    

}

?>