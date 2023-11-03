$array = json_decode(file_get_contents('php://input'), true);
$fromMe  = $array["key"]["fromMe"];//Mensagem recebida ou enviada (true -> Enviada / false -> Recebida)
$type    = $array["messageType"];//Tipo de mensagem recebida
//
$phoneConect    = explode("@", $array["jid"])[0];//Telefone conectado na api
$chatid         = explode("@", $array["key"]["remoteJid"])[0];//Contato cliente
$name           = $array['pushName'];// Nome Cadastrado no Fone Celular Cliente
$body           = $data['messages'][0]['body'];// o que o cliente respondeu
$body_ios       = $array["message"]["extendedTextMessage"]["text"];
$conversa       = $array['message']['conversation'];

if($fromMe == false){
	switch ($type){
		case 'conversation'://Tipo chat
		case 'extendedTextMessage':// Tipo chat , porem, IOS
			$instance       = $array["instance_key"];//Instancia
			$body           = $array["message"]["conversation"];//Mensagem do chat
			if(status_conversa($chatid)){//COM CONVERSA
				if ($body == "#" or $body_ios == "#"){
					$message = 'Por Sua Escolha, Estamos Encerrando este Atendimento, Obrigado e Volte em *Breve!*';
					enviar_mensagem($chatid, $message);
					deleta_historico($chatid);
					exit;
				}
				if(strtoupper($body) == "PEDIDO" or strtoupper($body_ios) == "PEDIDO"){
					salva_historico($chatid, '', '', 'O cliente decidiu iniciar o pedido.', '001');
					historico_2($chatid, '', '', 'O cliente decidiu iniciar o pedido.', '001');
					$message = 'Estamos Iniciando Seu Pedido';
					enviar_mensagem($chatid, $message);
					$message = 'Informe o Produto Desejado:\n*Camiseta*\n*Calça*\n*Moletom*\n*Bermuda*';
					enviar_mensagem($chatid, $message);
				}elseif (strtoupper($body) == "CAMISETA" or strtoupper($body_ios) == "CAMISETA"){
					$message = 'Informe a *Quantidade* de Camisetas Desejadas, Após Escreva *Encerrar*';
					salva_historico($chatid, '', '', 'O cliente informou a quantidade de camisetas.', '002', $conversa);
					historico_2($chatid, '', '', 'O cliente informou a quantidade de camisetas.', '002', $conversa);
					enviar_mensagem($chatid, $message);
				}elseif (strtoupper($body) == "ENCERRAR" or strtoupper($body_ios) == "ENCERRAR"){
					$texto = soma_pedido($chatid);
					enviar_mensagem($chatid, $texto);
					$message = 'Pedido Encerrado, Obrigado e *Volte Sempre!*';
					enviar_mensagem($chatid, $message);
					salva_historico($chatid, '', '', 'O cliente informou a quantidade de camisetas.', '009');
					historico_2($chatid, '', '', 'O cliente informou a quantidade de camisetas.', '009');
					deleta_historico($chatid);
					deleta_pedido($chatid);
					envia_email($chatid, $name, $texto);
				}
				else{
					$ultimo = ultimo_codigo($chatid);
					switch($ultimo){
						case 2:
							if (!empty($body_ios)){
								$conversa = $body_ios;
							}
							$prod = 'Camiseta';
							$ultima_qt = ultima_qt($chatid);
							cria_pedido($chatid, $prod, $conversa);
							break;
							default:
                           $message = 'Opção Inválida, Favor *Tentar Novamente!*';
						   enviar_mensagem($chatid, $message);

					}		 
				}
				if(strtoupper($body) == "FINANCEIRO" or strtoupper($body_ios) == "FINANCEIRO"){
					msg_financeiro($name, $chatid);
				}
				if(strtoupper($body) == "ADMINISTRATIVO" or strtoupper($body_ios) == "ADMINISTRATIVO"){
					msg_adm($name, $chatid);
				}
			}else{// se for a primeeira vez
				salva_historico($chatid, '', '', 'Mensagem de boas vindas.', '000');
				$message = "Olá, seja bem vindo ao nosso atendimento virtual. O Primeiro Passo é digitar a palavra *PEDIDO* para realizar um Novo Pedido ou para falar com outros setores as opções são: *FINANCEIRO* ou *ADMINISTRATIVO*. Caso Decidas Desistir, Basta Que Seja Pressionado *#*";
				$time    = $array["messageTimestamp"];//Hora e data que foi enviada
				enviar_mensagem($chatid, $message);
			} // fim else primeira vez
			break;
	}
	exit;
}
else{
	echo "From True => ".$fromMe."<br>";
}