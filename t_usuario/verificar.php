<?php
include "../includes/conexao.php";

$email = $_GET['email'] ?? '';

$mensagem = "";
$sucesso = false;

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $codigo = $_POST["codigo"];
    $email = $_POST["email"];

    $sql = "SELECT * FROM usuarios 
            WHERE email='$email' AND codigo_verificacao='$codigo'";

    $res = mysqli_query($conexao, $sql);

    if (mysqli_num_rows($res) > 0) {
        mysqli_query($conexao, 
        "UPDATE usuarios SET verificado=1 WHERE email='$email'");

        $mensagem = "Conta verificada com sucesso!";
        $sucesso = true;
    } else {
        $mensagem = "Código inválido!";
    }
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
<meta charset="UTF-8">
<title>Verificação</title>
<link rel="stylesheet" href="../stylelogin.css">
</head>
<body>

<div class="container">
    <form class="login" method="POST">

        <div class="icon">📧</div>
        <h1>Verificar Conta</h1>

        <?php if ($mensagem) { ?>
            <p style="color: white; margin-bottom: 15px;">
                <?php echo $mensagem; ?>
            </p>
        <?php } ?>

        <?php if (!$sucesso) { ?>
            <div class="input-box">
                <input type="hidden" name="email" value="<?php echo $email; ?>">
                <input name="codigo" required>
                <label>Código de verificação</label>
            </div>

            <button type="submit">VERIFICAR</button>


        <?php } else { ?>
            
            <div class="options">
                <a href="..\login.php">Ir para login</a>
            </div>

        <?php } ?>

    </form>
</div>

</body>
</html>