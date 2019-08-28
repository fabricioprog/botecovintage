<?php
class Conta_model extends CI_Model
{

    public function __construct()
    {
        parent::__construct();
    }

    public function get_mesas_status()
    {
        $sql = "select cd_mesa, ci_conta codigo, cd_status status from tb_conta c
                where cd_status in (2,3,4)";
        return $this->db->query($sql)->result();
    }

    public function get_conta_aberta_by_mesa($cd_conta)
    {
        $sql = "select
                    ci_conta, cd_mesa, cd_status,
                    TO_CHAR(dt_inicio, 'DD/MM/YYYY HH:mm:SS') dt_inicio,
                    TO_CHAR(dt_fim, 'DD/MM/YYYY HH:mm:SS') dt_fim, nr_total
                    from tb_conta
                    where cd_status = 2 and dt_inicio is not null and dt_fim is null and ci_conta = ?
                    order by dt_inicio";        
        return $this->db->query($sql, array($cd_conta))->row();
    }

    public function add_conta($cd_mesa, $cd_status, $dt_abrir)
    {
        $sql = "INSERT INTO tb_conta values (default,?,?,?,null,0) returning ci_conta";
        return $this->db->query($sql, array($cd_mesa, $cd_status, $dt_abrir))->row();
    }

    //Finaliza conta com o preço total que foi calculado, Se não tiver feito nenhum pedido, remove conta.
    public function encerrar_conta($cd_conta,$total){
        $sql = "SELECT * FROM tb_pedido where cd_conta = ?";
        $pedidos = $this->db->query($sql,array($cd_conta))->result();
        if(count($pedidos) > 0){
            $sql = "update tb_conta set cd_status = 5 , dt_fim = now(), nr_total = ? where ci_conta = ?";
            $this->db->query($sql,array($total,$cd_conta));                
        }else{
            $sql = "delete from tb_conta where ci_conta = ?";
            $this->db->query($sql,array($cd_conta));
        }
    }



}