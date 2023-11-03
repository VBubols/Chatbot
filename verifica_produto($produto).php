$sql = "SELECT COUNT(*) FROM produtos WHERE id = '".$produto."'";
sc_lookup(ds, $sql);
if({ds} !== false) {
	if({ds[0][0]} == 0) {
		return false;
	} else {
		return true;
	}
}
