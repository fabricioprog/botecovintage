<?php
class Pedido_model extends CI_Model
{

    public function __construct()
    {
        parent::__construct();
    }

    
    public function get_pedidos($cd_conta, $somatorio = false)
    {                
        $sql = "select  prod.ci_produto,prod.nm_produto, prod.cd_categoria,
        ped.quantidade,
        prod.valor_venda,  
        cat.fl_dez_porcento,      
        (ped.quantidade * prod.valor_venda) as total,
        prod.valor_venda::money lbl_valor_venda,
        (ped.quantidade * prod.valor_venda)::money lbl_total        
        from tb_pedido ped        
        inner join tb_produto prod on ped.cd_produto = prod.ci_produto
        inner join tb_categoria cat on cat.ci_categoria = prod.cd_categoria
        where cd_conta = ?";
        if($somatorio){
            $sql = "select  
            coalesce(sum(total),0) soma,
            coalesce(sum(total),0)::money lbl_soma,
            coalesce(round((sum(case when fl_dez_porcento then total else 0 end) *0.1),2),0) dez_porcento ,
            coalesce(round((sum(case when fl_dez_porcento then total else 0 end) *0.1),2),0)::money lbl_dez_porcento ,
            (coalesce(sum(total),0) + 
             coalesce(round((sum(case when fl_dez_porcento then total else 0 end) *0.1),2),0)) valor_total,		
            (coalesce(sum(total),0) + 
             coalesce(round((sum(case when fl_dez_porcento then total else 0 end) *0.1),2),0))::money total
            from ( $sql ) conta ";
            return $this->db->query($sql, array($cd_conta))->row();
        }
        
        return $this->db->query($sql, array($cd_conta))->result();
    }

    public function get_produto_conta($cd_conta, $cd_produto)
    {

        $sql = "select * from tb_pedido where cd_conta = ? and cd_produto = ? ";
        return $this->db->query($sql,array($cd_conta, $cd_produto))->row();

    }

    public function update_pedido($cd_conta, $cd_produto, $quantidade)
    {
        $sql = "UPDATE tb_pedido set quantidade = ? where cd_conta = ? and cd_produto = ?";
        $this->db->query($sql, array($quantidade, $cd_conta, $cd_produto));        
    }

    public function remove_produto_conta($cd_produto,$cd_conta){
        $sql = "delete from tb_pedido where cd_produto = ? and cd_conta = ?";
        $this->db->query($sql,array($cd_produto,$cd_conta));

    }


    public function get_pedido_cozinha_livre(){
        $sql = "SELECT * FROM tb_pedido_cozinha pc
        inner join tb_produto p on p.ci_produto = pc.cd_produto
        where dt_fim is null order by pc.dt_inicio";
        return $this->db->query($sql)->result();
    }

    

    public function get_conta_produto($cd_conta,$cd_produto){
        $sql = "select ped.* from tb_pedido ped
                inner join tb_conta c on c.ci_conta = ped.cd_conta
                where c.ci_conta = ? and ped.cd_produto  = ? and c.cd_status = 2";
       return $this->db->query($sql,array($cd_conta,$cd_produto))->row();         
    }

    public function add_pedido($cd_conta, $cd_produto)
    {
        $sql = "INSERT INTO tb_pedido values (?,?,1)";
        $this->db->query($sql, array($cd_conta, $cd_produto));
    }

}