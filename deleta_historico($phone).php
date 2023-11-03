// SQL statement parameters
$delete_table  = 'historico';      // Table name
$delete_where  = "phone = '$phone'"; // Where clause

// Delete record
$delete_sql = 'DELETE FROM ' . $delete_table
    . ' WHERE '      . $delete_where;
sc_exec_sql($delete_sql);