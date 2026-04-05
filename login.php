<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nutri&Treino</title>
    <link rel="stylesheet" href="stylelogin.css
	">
</head>
<body>

<div class="container">
    <form class="login" action="validar.php" method="POST">
        
        <div class="icon">👤</div>
        <h1>Login</h1>

        <div class="input-box">
            <input type="email" name="email" required>
            <label>Email</label>
        </div>

        <div class="input-box">
            <input type="password" name="senha" required>
            <label>Senha</label>
        </div>

        <div class="options">
            <a href="#">Cadastrar</a>
            <a href="#">Esqueceu a senha?</a>
        </div>

        <button type="submit">LOGIN</button>

    </form>
</div>


</body>
</html>