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
        $sql = "SELECT * FROM tb_produto where ci_produto = ? ";
        return $this->db->query($sql,array($ci_produto))->row();
    }

    public function add_produto($nome,$descricao,$nr_estoque,$imagem,$tp_imagem,$cd_categoria,$valor_venda) {        
        $sql = "INSERT INTO tb_produto values (default,?,?,true,false,?,?,?,?,?)";
        $this->db->query($sql,array($nome,$descricao,$nr_estoque,$imagem,$tp_imagem,$cd_categoria,$valor_venda));        
    }

}

?>