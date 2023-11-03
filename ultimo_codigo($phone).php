$sql = "SELECT code FROM historico WHERE phone = '".$phone."' ORDER BY id DESC";
sc_lookup(ds, $sql);
if({ds} !== false) {
	return {ds[0][0]};
}
