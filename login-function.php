<?php 
	// inicia a sessao
	session_start();
	// verifica a conexao
	require("conexao.php");
	// verifica os campos que foram preenchidos no login
	if (isset($_POST['efetuarLogin'])) 
	{
		// caso o campo esteja vazio, ele vai printar na tela usando o status, onde ele vai informar qual campo esta vazio, ele so da segmento se todos os campos forem devidamente preenchidos
		$emailLogin = $_POST['emailLogin'];
		if ($emailLogin == "") 
		{
			header("Location: login.php?status=faltaEmailLogin");
			exit();
		}
		$senhaLogin = $_POST['senhaLogin'];
		if ($senhaLogin == "") 
		{
			header("Location: login.php?status=faltaSenhaLogin");
			exit();
		}
		// ele esta incriptando a senha e comparando com a senha incriptada no banco, ver se conferem, se conferir, ta ok
		$senha = md5($senhaLogin);

		// seleciona os dados do usuario no banco, caso esses dados estejam corretos
		$sqlLogar = "SELECT * FROM login WHERE email = '$emailLogin' AND senha = '$senha'";
		$stmtLogar = sqlsrv_query($conexao, $sqlLogar);
		if ($stmtLogar === false) 
		{
			die(print_r(sqlsrv_errors(), true));
		}
		$aLogar = array();
		while($rowLogar = sqlsrv_fetch_array($stmtLogar, SQLSRV_FETCH_ASSOC) )
		{
			$aLogar[] = $rowLogar;
		}
				// verifica se existe dados que conferem com o que foi digitado, eu poderia colocar maior que 0, porem, fica mais facil de hackear, e melhor colocar == a 1, ja que tem de ter apenas um registro com o mesmo email
		if (count($aLogar) != 1) 
		{
			header("Location: login.php?status=emailSenhaIncorretos");
			exit();
		}
		else
		{
			$_SESSION['id'] = $aLogar[0]['id'];
			header("Location: logado.php");
		}
	}
?>