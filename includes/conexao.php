<?php
$host = getenv("MYSQLHOST");
$user = getenv("MYSQLUSER");
$pass = getenv("MYSQLPASSWORD");
$db   = getenv("MYSQLDATABASE");
$port = getenv("MYSQLPORT");

$conexao = mysqli_connect($host, $user, $pass, $db, $port);

if (!$conexao) {
    die("Erro de conexão com o banco");
}