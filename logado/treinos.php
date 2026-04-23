<?php
session_start();
include "../includes/conexao.php";

$usuario_id = $_SESSION["usuario_id"];

$sql = "SELECT * FROM dados_fisicos WHERE usuario_id = $usuario_id";
$res = mysqli_query($conexao, $sql);

$dados = mysqli_fetch_assoc($res);
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Treinos - Nutri&Treino</title>
  <link rel="stylesheet" href="../css/stylestreinos.css">

</head>

<body>

<!-- ===== HEADER ===== -->
<header class="site-header">

  <div class="topbar container">

    <a href="usuariologado.php">
      <img src="../img/logonutri.png" alt="Nutri & Treino" class="logo">
    </a>

    <form class="search">
        <input type="search" placeholder="Buscar" aria-label="Buscar" />
        <button type="submit" aria-label="Pesquisar">
          <!-- ícone lupa -->
          <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
               stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
            <circle cx="11" cy="11" r="8"></circle>
            <line x1="21" y1="21" x2="16.65" y2="16.65"></line>
          </svg>
        </button>
      </form>

      <nav class="quick-icons" aria-label="Acesso rápido">
        
          <!-- ícone usuário -->
          <a href="#" onclick="abrirPainel()"> 
          <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
               stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
            <path d="M20 21a8 8 0 0 0-16 0"></path>
            <circle cx="12" cy="7" r="4"></circle>
          </svg>
        </a>
        
          <!-- ícone sacola -->
          <svg class="icone-cesta"
     width="22" height="22"
     viewBox="0 0 24 24"
     fill="none"
     stroke="currentColor"
     stroke-width="2"
     stroke-linecap="round"
     stroke-linejoin="round"
     aria-hidden="true">
  <path d="M6 2h12l2 7H4l2-7Z"></path>
  <path d="M9 10v10a3 3 0 0 0 3 3 3 3 0 0 0 3-3V10"></path>
</svg>
        </a>
    
          <!-- ícone coração -->
          <svg width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
               stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
            <path d="M20.8 4.6a5.5 5.5 0 0 0-7.8 0L12 5.6l-1-1a5.5 5.5 0 0 0-7.8 7.8l1 1L12 22l7.8-8.6 1-1a5.5 5.5 0 0 0 0-7.8Z"></path>
          </svg>
        </a>
      </nav>
    </div>


    
  <nav class="main-nav" aria-label="Principal">
        <ul class="nav-list">
            <li class="nav-item"><a class="nav-link" href="../consultas.php">Consultas</a></li>
            <li class="nav-item"><a class="nav-link"href="treinos.php">Treinos</a></li>
            <li class="nav-item"><a class="nav-link" href="produto.php">Produtos</a></li>
            <li class="nav-item"><a class="nav-link" href="gympass.php">Buscar Academias</a></li>
            <li class="nav-item"><a class="nav-link" href="planos.php">Planos</a></li>
        </ul>
    </nav>
  </header>

<!-- ===== MAIN – FUNDO VERDE ===== -->
<main class="page-bg">

  <!-- BLOCO BRANCO DO PLANO DE TREINO -->
  <section class="treino-box">

    <h2 class="titulo">Personalização de treinos</h2>

<div class="treinos">

  <div class="dia">
    <div class="titulo-dia">Segunda</div>
    <textarea id="segunda"></textarea>
  </div>

  <div class="dia">
    <div class="titulo-dia">Terça</div>
    <textarea id="terca"></textarea>
  </div>

  <div class="dia">
    <div class="titulo-dia">Quarta</div>
    <textarea id="quarta"></textarea>
  </div>

  <div class="dia">
    <div class="titulo-dia">Quinta</div>
    <textarea id="quinta"></textarea>
  </div>

  <div class="dia">
    <div class="titulo-dia">Sexta</div>
    <textarea id="sexta"></textarea>
  </div>

  <div class="dia">
    <div class="titulo-dia">Sábado</div>
    <textarea id="sabado"></textarea>
  </div>

  <div class="dia">
    <div class="titulo-dia">Domingo</div>
    <textarea id="domingo"></textarea>
  </div>

</div>

<div class="botoes">
<button class="salvar" onclick="salvarTreinos()">Salvar treinos</button>
<button class="limpar" onclick="limparTreinos()">Limpar tudo</button>
</div>

  </section>

</main>

<!-- ===== FOOTER ===== -->
<footer class="footer">

  <div class="footer-container">

    <div class="footer-col">
      <h3>Nutri&Treino</h3>
      <p>Saúde, bem‑estar e alimentação equilibrada ao seu alcance.</p>
    </div>

    <div class="footer-col">
      <h4>Seções</h4>
      <ul>
        <li><a href="../consultas.php">Consultas</a></li>
        <li><a href="treinos.php">Treinos</a></li>
        <li><a href="produto.php">Produtos</a></li>
        <li><a href="planos.php">Planos</a></li>
      </ul>
    </div>

    <div class="footer-col">
      <h4>Contato</h4>
      <p>📞 (19) 99522‑5598</p>
      <p>📧 contato@nutritreino.com</p>
    </div>

    <div class="footer-col">
      <h4>Siga‑nos</h4>
      <div class="social">📸 📘 ▶️</div>
    </div>

  </div>

  <div class="footer-copy">
    © 2026 Nutri&Treino — Todos os direitos reservados.
  </div>

</footer>

<!-- ===== PAINEL LATERAL ===== -->
   <form id="painel" class="painel" method="POST" action="t_usuario/salvar_perfil.php">

    <button type="button" class="fechar" onclick="fecharPainel()">✖</button>

    <h2>Perfil</h2>

    <p class="nome-usuario">
    <?php echo $_SESSION["usuario_nome"]; ?>
</p>

    <div class="item">
        <label>Genero</label>
        <select name="genero" required>
            <option value="Masculino"
              <?php if(($dados['genero'] ?? '') == "Masculino") echo "selected"; ?>>
              Masculino
            </option>
            <option value="Feminino"<?php if(($dados['genero'] ?? '') == "Feminino") echo "selected"; ?>>
              Feminino
            </option>
        </select>
    </div>

    <div class="item">
        <label>Altura</label>
        <input type="text" name="altura" value="<?php echo $dados['altura'] ?? ''; ?>" placeholder="Ex: 1.75" required>
    </div>

    <div class="item">
        <label>Idade</label>
        <input type="number" name="idade" value="<?php echo $dados['idade'] ?? ''; ?>" required>
    </div>

    <div class="item">
        <label>Peso</label>
        <input type="number" name="peso" value="<?php echo $dados['peso'] ?? ''; ?>" required>
    </div>

    <button type="submit">Salvar</button>

</form>
  
</div>

<script>
function abrirPainel() {
    document.getElementById("painel").classList.add("ativo");
}

function fecharPainel() {
    document.getElementById("painel").classList.remove("ativo");
}
</script>

<script src="../treinos.js"></script>



</body>
</html>