$sql = "INSERT INTO historico2 (phone, pedido, produto, conteudo, code, qt) VALUES ('".$phone."', '".$pedido."', '".$produto."', '".$conteudo."', '".$code."', '".$qt."')";
sc_exec_sql($sql);