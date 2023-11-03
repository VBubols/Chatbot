$sql_qt = "SELECT qt FROM historico WHERE phone = '".$phone."' ORDER BY id DESC";
sc_lookup(ds_qt, $sql_qt);
if({ds_qt} !== false) {
	return {ds_qt[0][0]};
}
