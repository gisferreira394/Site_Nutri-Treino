<?php
$bd_servidor = getenv("MYSQLHOST");
$bd_usuario  = getenv("MYSQLUSER");
$bd_senha    = getenv("MYSQLPASSWORD");
$bd_banco    = getenv("MYSQLDATABASE");
$bd_porta    = getenv("MYSQLPORT");

$conexao = mysqli_connect(
    $bd_servidor,
    $bd_usuario,
    $bd_senha,
    $bd_banco,
    $bd_porta
);

if (!$conexao) {
    die("Erro ao conectar ao banco de dados");
}
