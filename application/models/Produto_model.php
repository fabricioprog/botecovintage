<?php 
class Produto_model extends CI_Model{

    public function __construct() {		
        parent::__construct();
	}

    public function get_produtos_by_categoria($cd_categoria){
        $sql = "SELECT * FROM tb_produto where cd_categoria = ? ";
        return $this->db->query($sql,array($cd_categoria))->result();
    }

    public function get_produto($ci_produto){
        $sql = "SELECT * FROM tb_produto where ci_produto = ? order by nm_produto ";
        return $this->db->query($sql,array($ci_produto))->row();
    }

    public function add_produto($nome,$descricao,$nr_estoque,$imagem,$tp_imagem,$cd_categoria,$valor_venda) {        
        $sql = "INSERT INTO tb_produto values (default,?,?,true,false,?,?,?,?,?)";
        $this->db->query($sql,array($nome,$descricao,$nr_estoque,$imagem,$tp_imagem,$cd_categoria,$valor_venda));        
    }

    public function update_produto($nome,$descricao,$nr_estoque,$imagem,$tp_imagem,$cd_categoria,$valor_venda,$ci_produto) {
        $params = array($nome,$descricao,$nr_estoque,$cd_categoria,$valor_venda);
        $sql_tp_imagem = "";
        if($imagem && $tp_imagem){            
            $sql_tp_imagem = ", img_produto= ?,tp_imagem= ? ";
            $params[] = $imagem;
            $params[] = $tp_imagem;
        }
        $params[] = $ci_produto;
        $sql = "update tb_produto set nm_produto = ?,ds_produto=?,nr_estoque=?, cd_categoria=?,valor_venda=? $sql_tp_imagem where ci_produto = ?";
        $this->db->query($sql,$params);        
    }

}

?>