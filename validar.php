<?php
session_start(); // 👈 IMPORTANTE

include "includes/conexao.php";

$email = $_POST["email"];
$senha = $_POST["senha"];

$sql = "SELECT * FROM usuarios 
        WHERE email='$email' AND verificado=1";

$res = mysqli_query($conexao, $sql);

if (mysqli_num_rows($res) > 0) {
    $user = mysqli_fetch_assoc($res);

    if (password_verify($senha, $user["senha"])) {

        // salva na sessão
        $_SESSION["usuario_id"] = $user["id"];
        $_SESSION["usuario_nome"] = $user["nome"];

        // redireciona
        header("Location: usuariologado.php");
        exit;

    } else {
        header("Location: login.php?erro=senha");
        exit;
    }

} else {
    header("Location: login.php?erro=conta");
    exit;
}
?>