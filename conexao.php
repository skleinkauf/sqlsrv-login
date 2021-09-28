<?php

		// conexao, onde buscar(DESKTOP-N9LLTPG), qual usuario esta buscando(mika), a senha do usuario(123456) e o banco de dados que deseja conexao(login)
	define("DB_NAME","login");
	define("DB_HOST","DESKTOP-N9LLTPG");
	define("DB_USER","mika");
	define("DB_PASS","123456");

		// aqui ele conecta, ele checa para ver se as informacoes conferem, caso esteja tudo ok, ele efetua a conexao, e ja podemos trabalhar com o banco
    try
    { 
    	$conInfo = array( "Database"=> DB_NAME, "UID"=> DB_USER, "PWD"=>DB_PASS);
    	$conexao = sqlsrv_connect(DB_HOST, $conInfo);
    
    // aqui ele checa por erros, caso esteja errada a conexao, o echo vai mostrar minha mensagem, juntamente com o erro que foi gerado, ajuda bastante no debuggin
    }
    catch (Exception $e)
    {
    	echo 'Erro na conexao: ';
    	echo $e->getMessage();
    }

?>