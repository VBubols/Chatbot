$string_produtos = "";
$sql = "SELECT CONCAT('*', id, '*', ' - ', nome, ' -> ', FORMAT(valor, 2, 'de_DE'), '\n') AS produto FROM produtos";
sc_select(rs, $sql);
if({rs} !== false) {
	while(!$rs->EOF) {
		
		$string_produtos .= $rs->fields[0];
		
		$rs->MoveNext();
	}
	$rs->Close();
	return $string_produtos;
}