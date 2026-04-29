<?php
session_start();

require "db.php"; // NOVO ARQUIVO DE CONEXÃO (PDO)

$email = $_POST["email"] ?? null;
$senha = $_POST["senha"] ?? null;

if (!$email || !$senha) {
    header("Location: login.php?erro=conta");
    exit;
}

$stmt = $pdo->prepare("
    SELECT * FROM usuarios 
    WHERE email = ? AND verificado = 1
");
$stmt->execute([$email]);
$user = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$user) {
    header("Location: login.php?erro=conta");
    exit;
}

if (!password_verify($senha, $user["senha"])) {
    header("Location: login.php?erro=senha");
    exit;
}

// login OK
$_SESSION["usuario_id"]   = $user["id"];
$_SESSION["usuario_nome"] = $user["nome"];

header("Location: logado/usuariologado.php");
exit;
