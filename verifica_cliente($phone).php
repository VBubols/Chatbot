$sql = "SELECT COUNT(*) FROM clientes WHERE phone =  '".$phone."'";
sc_lookup(ds, $sql);
if({ds} !== false) {
	if({ds[0][0]} == 0) {
		return false;
	} else {
		return true;
	}
}
