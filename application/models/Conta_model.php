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


    public function get_conta($ci_conta){
        $sql = "SELECT * FROM  tb_conta where ci_conta = ?";
        return $this->db->query($sql,array($ci_conta))->row();
    }

    public function get_conta_aberta_by_mesa($cd_conta)
    {
        $sql = "select
                    ci_conta, cd_mesa, cd_status,
                    TO_CHAR(dt_inicio, 'DD/MM/YYYY HH:MI:SS') dt_inicio,
                    TO_CHAR(dt_fim, 'DD/MM/YYYY HH:mm:SS') dt_fim, nr_total
                    from tb_conta
                    where cd_status NOT IN(1,5) and dt_inicio is not null and dt_fim is null and ci_conta = ?
                    order by dt_inicio";        
        return $this->db->query($sql, array($cd_conta))->row();
    }

    public function add_conta($cd_mesa, $cd_status, $dt_abrir)
    {
        $sql = "INSERT INTO tb_conta values (default,?,?,?,null,0,0,true) returning ci_conta";
        return $this->db->query($sql, array($cd_mesa, $cd_status, $dt_abrir))->row();
    }

    public function atualizar_status_conta($ci_conta,$cd_status,$dt_inicio){
        $sql = "UPDATE tb_conta set cd_status = ?, dt_inicio = ? WHERE ci_conta = ?";
        $this->db->query($sql,array($cd_status,$dt_inicio,$ci_conta));
    }

    public function atualiza_status_dez_porcento($valor_dez_porcento,$cd_conta){
        $sql = "update tb_conta set fl_dez_porcento = ? where ci_conta = ?";
        $this->db->query($sql,array($valor_dez_porcento,$cd_conta));
    }

    //Finaliza conta com o preço total que foi calculado, Se não tiver feito nenhum pedido, remove conta.
    public function encerrar_conta($cd_conta,$nr_dez_porcento,$total){        
        $sql = "SELECT * FROM tb_pedido where cd_conta = ?";
        $pedidos = $this->db->query($sql,array($cd_conta))->result();
        if(count($pedidos) > 0){
            $sql = "update tb_conta set cd_status = 5 , dt_fim = now(), nr_total = ? , nr_dez_porcento = ? where ci_conta = ?";            
            $this->db->query($sql,array($total,$nr_dez_porcento,$cd_conta));                
        }else{
            $sql = "delete from tb_conta where ci_conta = ?";
            $this->db->query($sql,array($cd_conta));
        }
    }
//TODO: Adicionar intervalo de tempo para pesquisa
    public function get_contas_periodo($dt_inicio,$dt_fim,$total = false){
        $sql = "select                 
                prod.ci_produto,
                prod.nm_produto,
                prod.valor_venda,		
                prod.valor_venda:: money lbl_valor_venda,                                
                sum(ped.quantidade) quantidade, 
                sum(prod.valor_venda*ped.quantidade)  total,
                sum(prod.valor_venda*ped.quantidade)::money  lbl_total                                
                from tb_pedido ped
        inner join tb_produto prod on prod.ci_produto = ped.cd_produto        
        inner join tb_conta c on ped.cd_conta = c.ci_conta        
        where c.cd_status = 5 /* adiciona intervalo de tempo */
        group by 1,2 ";
        
        if($total){
            $sql = "select sum(total)::money total  from ($sql) conta ";
        }
        
        return $this->db->query($sql)->result();
    }



}