// SQL statement parameters
$delete_table_ped  = 'pedido';      // Table name
$delete_where_ped  = "cliente = '$phone'"; // Where clause

// Delete record
$delete_sql_ped = 'DELETE FROM ' . $delete_table_ped
    . ' WHERE '      . $delete_where_ped;
sc_exec_sql($delete_sql_ped);