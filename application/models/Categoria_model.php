<?php 
class Categoria_model extends CI_Model{

    public function __construct() {		
        parent::__construct();
	}

    public function get_categorias(){
        $sql = "SELECT * FROM public.tb_categoria";
        return $this->db->query($sql)->result();
    }

    public function add_categoria($nome,$descricao,$tp_imagem,$imagem){
        $sql = "INSERT INTO tb_categoria values (default,?,?,?,?,true)";
        $this->db->query($sql,array($nome,$descricao,$tp_imagem,$imagem));
    }

    

}

?>