<?php
// Configura o PHP para o português Brasil
setlocale(LC_ALL, 'pt_BR', 'pt_BR.utf-8', 'pt_BR.utf-8', 'portuguese');
// Seta o nosso fuso horário ao PHP
date_default_timezone_set('America/Sao_Paulo');

// Cria a string de conexão ao banco, setando o banco, nome do bd e o host
$dsn = "mysql:dbname=blog-php;host=127.0.0.1";
// Variável para o user
$dbuser = "root";
// Variável para a senha
$dbpass = "";

try {
  // Utiliza o PDO passando como parâmetros os dados para conexão ao banco
  // Armazena os dados da conexão à variável $pdo, passando também os métodos da POO presentes nessa função
  $pdo = new PDO($dsn, $dbuser, $dbpass);
} catch (PDOException $e) {
  echo "Falhou: ".$e->getMessage();
}
