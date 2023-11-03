$para = 'fernando@proxcom.eti.br';
$smtp = 'mail.XXX.XX.BR';
$usuario = 'fernando@proxcom.eti.br';
$senha = 'SENHA';
$de = 'fernando@proxcom.eti.br';
$assunto = 'Pedido Efetuado';
$vcopias = 'paulo.202120762@unilasalle.edu.br';
$mensagem = 'Gerado Automaticamente Pelo Chatbot Cliente, Fone e Produto => '.$nome." ".$phone." ".$produtos;
sc_mail_send($smtp,$usuario,$senha,$de,$para,$assunto,$mensagem,'H',$vcopias, '',58700, 'N', '', '');

