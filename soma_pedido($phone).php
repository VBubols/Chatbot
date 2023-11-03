$sql_pedido = "SELECT produto, sum(quant) FROM pedido WHERE cliente = '".$phone."' GROUP BY produto";
sc_lookup(ds_pedido, $sql_pedido);
if({ds_pedido} !== false) {
	$soma = "Produto => ".{ds_pedido[0][0]}." Quantidade => ".{ds_pedido[0][1]};
	return $soma;
}