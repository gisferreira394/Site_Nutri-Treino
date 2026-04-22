<?php  
$mensagem = "";
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
<meta charset="UTF-8">
<title>Cadastro</title>
<link rel="stylesheet" href="../css/stylelogin.css">
</head>
<body>

<div class="container">
    <form class="login" action="inserir.php" method="POST">

        <div class="icon">📝</div>
        <h1>Criar Conta</h1>

        <?php if ($mensagem) { ?>
            <p style="color: white; margin-bottom: 15px;">
                <?php echo $mensagem; ?>
            </p>
        <?php } ?>

        <!-- NOME -->
        <div class="input-box">
            <input type="text" name="nome" required>
            <label>Nome</label>
        </div>

        <!-- EMAIL -->
        <div class="input-box">
            <input type="email" name="email" required>
            <label>Email</label>
        </div>

        <!-- SENHA -->
        <div class="input-box">
            <input type="password" name="senha" required>
            <label>Senha</label>
        </div>

        <!-- BOTÃO -->
        <button type="submit">CADASTRAR</button>

    </form>
</div>

</body>
</html>