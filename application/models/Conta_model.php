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

    public function get_conta_aberta_by_mesa($cd_conta, $somatorio = false)
    {
        $sql = "select
                    ci_conta, cd_mesa, cd_status,
                    TO_CHAR(dt_inicio, 'DD/MM/YYYY HH:mm:SS') dt_inicio,
                    TO_CHAR(dt_fim, 'DD/MM/YYYY HH:mm:SS') dt_fim, nr_total
                    from tb_conta
                    where cd_status = 2 and dt_inicio is not null and dt_fim is null and ci_conta = ?
                    order by dt_inicio";
        if ($somatorio) {
            $sql = "SELECT sum(conta) total_conta, sum(conta)::money lbl_total_conta  from ($sql) conta; ";
        }
        return $this->db->query($sql, array($cd_conta))->row();
    }

    public function add_conta($cd_mesa, $cd_status, $dt_abrir)
    {
        $sql = "INSERT INTO tb_conta values (default,?,?,?,null,0) returning ci_conta";
        return $this->db->query($sql, array($cd_mesa, $cd_status, $dt_abrir))->row();
    }

}
