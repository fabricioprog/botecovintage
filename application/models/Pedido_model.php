<?php
class Pedido_model extends CI_Model
{

    public function __construct()
    {
        parent::__construct();
    }

    public function get_pedidos($cd_conta)
    {
        $sql = "select  prod.ci_produto,prod.nm_produto,
        ped.quantidade,
        prod.valor_venda,
        (ped.quantidade * prod.valor_venda) as total,
        prod.valor_venda::money lbl_valor_venda,
        (ped.quantidade * prod.valor_venda)::money lbl_total        
        from tb_pedido ped        
        inner join tb_produto prod on ped.cd_produto = prod.ci_produto
        where cd_conta = ?";
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

    public function add_pedido($cd_conta, $cd_produto)
    {
        $sql = "INSERT INTO tb_pedido values (?,?,1)";
        $this->db->query($sql, array($cd_conta, $cd_produto));
    }

}
