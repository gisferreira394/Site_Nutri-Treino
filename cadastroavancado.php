<?php
session_start();

if (!isset($_SESSION["usuario_id"])) {
    // não está logado
    $naoLogado = true;
} else {
    $naoLogado = false;

    include "includes/conexao.php";

    $usuario_id = $_SESSION["usuario_id"];

    $sql = "SELECT nome, email FROM usuarios WHERE id = $usuario_id";
    $res = mysqli_query($conexao, $sql);
    $dados = mysqli_fetch_assoc($res);
}
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
  <meta charset="UTF-8">
  <title>Cadastro | Nutri&Treino</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="stylecadastro.css">
</head>

<body>

  <?php if ($naoLogado): ?>

<div class="login-alert">
    <h2>🔒 Acesso restrito</h2>
    <p>Você precisa estar logado para acessar essa página.</p>
    
    <a href="login.php" class="btn-login">Fazer login</a>
</div>

<?php else: ?>

  <main class="container">

    <h1>Cadastro de planos </h1>
    <p>Preencha seus dados para continuar:</p>

    <form action="processa-cadastro.php" method="POST" class="form-cadastro">
  
  <!-- Nome -->
  <label for="nome">Nome</label>
  <input type="text" id="nome" name="nome" value="<?php echo $dados['nome'] ?? ''; ?>" readonly>
  <!-- Email -->
  <label for="email">E-mail</label>
  <input type="email" id="email" name="email" value="<?php echo $dados['email'] ?? ''; ?>" readonly>

  <!-- Senha -->
  <label for="senha">Senha</label>
  <input type="password" id="senha" name="senha" required minlength="6">

  <!-- Confirmação de senha -->
  <label for="confirma-senha">Confirmar senha</label>
  <input type="password" id="confirma-senha" name="confirma_senha" required minlength="6">

  <!-- Plano escolhido -->
  <input type="hidden" name="plano" value="Plano A - Básico">


  <!-- Forma de pagamento -->
  <label for="pagamento">Forma de pagamento</label>
<select id="pagamento" name="pagamento" required>
  <option value="">Selecione...</option>
  <option value="cartao">Cartão de Crédito</option>
  <option value="pix">Pix</option>
  <option value="boleto">Boleto Bancário</option>
</select>

<!-- Campos do cartão (inicialmente escondidos) -->
<div id="dados-cartao" style="display:none; margin-top:1rem;">
  <label for="numero-cartao">Número do cartão</label>
  <input type="text" id="numero-cartao" name="numero_cartao" maxlength="16">

  <label for="validade">Validade (MM/AA)</label>
  <input type="text" id="validade" name="validade" maxlength="5">

  <label for="cvv">CVV</label>
  <input type="text" id="cvv" name="cvv" maxlength="3">
</div>


  <!-- Botão -->
  <button type="submit" class="btn-principal">
  <a href="pagamento-pixplanoC.html" class="btn-principal">Finalizar Cadastro</a>
</button>
</form>

    <a href="logado/planos.php" class="voltar">← Voltar para os planos</a>

  </main>

<script>
  document.addEventListener("DOMContentLoaded", function() {
    const pagamentoSelect = document.getElementById("pagamento");
    const dadosCartao = document.getElementById("dados-cartao");

    pagamentoSelect.addEventListener("change", function() {
      if (this.value === "cartao") {
        dadosCartao.style.display = "block"; // mostra os campos
      } else {
        dadosCartao.style.display = "none"; // esconde os campos
      }
    });
  });

  document.getElementById("plano").addEventListener("change", function() {
  const planoSelecionado = this.value;
  const valor = valoresPlanos[planoSelecionado];
  
  if (valor) {
    // salva o valor no localStorage para usar na página Pix
    localStorage.setItem("totalPix", valor.toFixed(2));
  }
});

</script>


</body>
</html>
<?php endif; ?>
