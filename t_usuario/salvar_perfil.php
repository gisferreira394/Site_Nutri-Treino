<?php
session_start();
include "../includes/conexao.php";

$usuario_id = $_SESSION["usuario_id"];

$genero = $_POST["genero"];
$altura = $_POST["altura"];
$idade = $_POST["idade"];
$peso = $_POST["peso"];

// verifica se já existe
$sql_check = "SELECT * FROM dados_fisicos WHERE usuario_id = $usuario_id";
$res = mysqli_query($conexao, $sql_check);
$dados = mysqli_fetch_assoc($res);

if (mysqli_num_rows($res) > 0) {

    // atualiza
    $sql = "UPDATE dados_fisicos 
            SET genero='$genero', altura='$altura', idade='$idade', peso='$peso'
            WHERE usuario_id=$usuario_id";

} else {

    // insere
    $sql = "INSERT INTO dados_fisicos (usuario_id, genero, altura, idade, peso)
            VALUES ($usuario_id, '$genero', '$altura', '$idade', '$peso')";
}

mysqli_query($conexao, $sql);

header("Location: ../logado/usuariologado.php"); // ou sua página
exit;
?>