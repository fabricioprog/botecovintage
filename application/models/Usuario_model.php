<?php 
class Usuario_model extends CI_Model{

    public function __construct() {		
        parent::__construct();
    }
    
    public function get_usuario_senha($usuario,$senha){
        $sql = "select ci_usuario,nm_usuario,cd_perfil from tb_usuario where nm_usuario = ? and nm_senha = md5(?);";
        return $this->db->query($sql,array($usuario,$senha))->row();        
    }

    
}

?>