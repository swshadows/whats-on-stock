<?php

// Inicia o arquivo .env
function init_dotenv()
{
	$file = fopen(".env", "w");
	$usr_input = readline("Nome de usuário do seu banco de dados: ");
	$pswd_input = readline("Senha do usuário do seu banco de dados: ");
	$usr = "USERNAME='$usr_input'\n";
	$pswd = "PASSWORD='$pswd_input'\n";
	$host = "HOST='localhost'\n";
	$db = "DB='whats-on-stock'\n";
	fwrite($file, $usr . $pswd . $host . $db);
	echo "✅ Dados inseridos\n";
}

// Executa uma migração ou inicialização do banco
function exec_migration()
{
	require './src/models/PDO.php';
	$pdo_conn = new PDOConnection('.env');
	$pdo = $pdo_conn->connect();
	$sql = file_get_contents('./src/database/init.sql');
	echo "🚀 Executando migração\n";
	$query = $pdo->exec($sql);
	echo $query ? "✅ Transação bem-sucedida\n" : "❌ Erro ao executar migração\n";
}

// Inicia o servidor
function init_prod_server($php_command)
{
	echo "🚀 Iniciando servidor PHP\n";
	shell_exec("$php_command");
}

// Inicia o servidor com Sass minificado
function init_dev_server($php_command, $sass_command)
{
	echo "🚀 Iniciando servidor PHP e Sass\n";
	shell_exec("$php_command & $sass_command");
}

// Função principal
function main()
{
	echo "\n";
	echo "0. Fazer bootstrap da aplicação\n";
	echo "1. Inicializar .env\n";
	echo "2. Inicializar banco\n";
	echo "3. Iniciar servidor\n";
	echo "4. Iniciar servidor com Sass (requer Sass)\n\n";
	$choice = readline("Digite uma opção: ");

	$php_command = "php -S localhost:3000 -t ./app";
	$sass_command = "sass --watch ./src/scss:./app/css --style compressed";

	switch ($choice) {
		case 0:
			init_dotenv();
			exec_migration();
			init_prod_server($php_command);
			break;
		case 1:
			init_dotenv();
			break;
		case 2:
			exec_migration();
			break;
		case 3:
			init_prod_server($php_command);
			break;
		case 4:
			init_dev_server($php_command, $sass_command);
			break;
		default:
			echo "❌ Opção inválida, saindo";
			exit;
	}
}

main();
