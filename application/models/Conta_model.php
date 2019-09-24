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

    public function transferir_mesa($ci_conta,$cd_nova_mesa){
        $sql = "update tb_conta set cd_mesa = ? where ci_conta = ? ";
        $this->db->query($sql,array($cd_nova_mesa,$ci_conta));

    }

    public function get_conta_aberta_by_mesa($cd_conta)
    {
        $sql = "select
                    ci_conta, cd_mesa, cd_status,fl_dez_porcento,
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
    public function encerrar_conta($cd_conta,$nr_dez_porcento,$pg_credito,$pg_debito,$pg_dinheiro){        
        $sql = "SELECT * FROM tb_pedido where cd_conta = ?";
        $pedidos = $this->db->query($sql,array($cd_conta))->result();
        if(count($pedidos) > 0){
            $total = $pg_credito + $pg_debito + $pg_dinheiro;
            $sql = "update tb_conta set cd_status = 5 , dt_fim = now(), nr_pagamento_credito =  ?, nr_pagamento_debito =  ?, nr_pagamento_dinheiro =  ?, nr_total = ? , nr_dez_porcento = ? where ci_conta = ?";            
            $this->db->query($sql,array($pg_credito,$pg_debito,$pg_dinheiro,$total,$nr_dez_porcento,$cd_conta));                
        }else{
            $sql = "delete from tb_conta where ci_conta = ?";
            $this->db->query($sql,array($cd_conta));
        }
        
    }

    public function get_contas_periodo($dt_inicio,$dt_fim){
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
        where c.cd_status = 5 and dt_fim between ? and ? 
        group by 1,2 order by quantidade DESC  ";
        return $this->db->query($sql,array($dt_inicio,$dt_fim))->result();
    }

    public function get_faturamento_periodo($dt_inicio,$dt_fim){
        $sql = " select 
                sum(nr_total)::money total, 
                sum(nr_dez_porcento)::money dez_porcento ,
                sum(nr_pagamento_debito)::money debito,
                sum(nr_pagamento_credito)::money credito,
                sum(nr_pagamento_dinheiro)::money dinheiro,
                count(*) contas_encerradas,
                (sum(nr_total)/count(*))::money consumo_medio, 
                to_char(avg( dt_fim - dt_inicio ), 'HH24:MI:SS') permanencia_media
                from tb_conta where cd_status= 5 and dt_fim between ? and ? ;";
        return $this->db->query($sql,array($dt_inicio,$dt_fim))->row();
    }

    public function get_faturamento_cover($dt_inicio,$dt_fim){
      $sql =  "select      
                (sum(prod.valor_venda * ped.quantidade) * 0.95)::money  valor       
                from tb_pedido ped
                inner join tb_conta c on c.ci_conta = ped.cd_conta
                inner join tb_produto prod on prod.ci_produto = ped.cd_produto
                
                where prod.cd_categoria = 13 and c.dt_fim between ? and ? ";
        return $this->db->query($sql,array($dt_inicio,$dt_fim))->row();                
    }

    public function get_rendimentos_semanais($ano_mes){        
        $sql = "select to_char(dt_inicio, 'W') semana,
        sum(nr_total + nr_dez_porcento) rendimento,
        count(ci_conta) mesas_encerradas,
        to_char(avg( dt_fim - dt_inicio ), 'HH24:MI:SS') permanencia_media,
        sum(nr_total + nr_dez_porcento) / count(ci_conta) consumo_medio
        from tb_conta 
        where to_char(dt_inicio, 'YYYY-MM') = ?
        group by 1 order by 1";
        return $this->db->query($sql,array($ano_mes))->result();
    }

    public function get_relatorio_consumo($ano_mes){
        $sql = "
        select to_char(c.dt_inicio, 'W') semana,        
        sum(case when prod.cd_categoria = 5 then prod.valor_venda else 0 end) bebidas,
        sum(case when prod.cd_categoria = 6 then prod.valor_venda else 0 end) refrigerantes,
        sum(case when prod.cd_categoria = 9 then prod.valor_venda else 0 end) bebidas_naturais,
        sum(case when prod.cd_categoria = 10 then prod.valor_venda else 0 end) petiscos,
        sum(case when prod.cd_categoria = 13 then prod.valor_venda else 0 end) cover        
        from tb_pedido ped
        inner join tb_conta c on ped.cd_conta = c.ci_conta
        inner join tb_produto prod on prod.ci_produto = ped.cd_produto
        where to_char(c.dt_inicio, 'YYYY-MM') = ?
        group by 1 order by 1";
        return $this->db->query($sql,array($ano_mes))->result();
    }



}