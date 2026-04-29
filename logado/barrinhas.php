<?php
session_start();
include "../includes/conexao.php";

$usuario_id = $_SESSION["usuario_id"];

$sql = "SELECT * FROM dados_fisicos WHERE usuario_id = $usuario_id";
$res = mysqli_query($conexao, $sql);

$dados = mysqli_fetch_assoc($res);
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Barrinhas</title>
    <link rel="stylesheet" href="../css/styleswhey.css">
</head>
<body>

   <header class="site-header">
    <div class="topbar container">
     
       <a href="usuariologado.php" class="logo-link">
    <img src="../img/logonutri.png" alt="Logo" class="logo">
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
          <!-- ícone sacola -->
          <a href="../carrinho.php" class="link-cesta" aria-label="Carrinho de compras">
  <svg
    class="icone-cesta"
    width="22"
    height="22"
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
 <a href="../favoritos.html" class="link-favorito" aria-label="favoritos">

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

    

    <!-- SUBMENU CATEGORIAS -->

    <nav class="categoria">
       <ul class="nav-lists">
            <li class="nav-item"><a class="nav-link" href="whey.php">Whey</a></li>
            <li class="nav-item"><a class="nav-link"href="pretreino.php">Pré-Treinos</a></li>
            <li class="nav-item"><a class="nav-link" href="barrinhas.php">Barrinhas</a></li>
            <li class="nav-item"><a class="nav-link" href="vitaminas.php">Vitaminas</a></li>
            <li class="nav-item"><a class="nav-link" href="creatina.php">Creatina</a></li>
        </ul>
    </nav>
 

    <!-- FAIXA DE CUPOM -->
    <div class="cupom">
        Ganhe 20% na primeira compra com cupom: <strong>PRIMEIRACOMPRA</strong>
    </div>

    <!-- ================= LISTA DE PRODUTOS ================= -->
    <section class="produtos">

        <!-- Produto 1 -->
       <div class="card">
            <img src="../imgbarrinha/morango.png">  
             <p class="titulo">Barra de proteína - Morango </p>
            <p class="preco verde">R$ 94,90 no PIX</p>
            <button>
               <a class="btn-comprar"
       href="../paginadoproduto.html?nome=Barra de proteína - Morango&preco=94.90&img=imgbarrinha/morango.png&desc=Barra de proteína - Morango">
        Comprar
    </a>
            </button>
        </div>

        <!-- Produto 2 -->
        <div class="card">
            <img src="../imgbarrinha/chocolate ao leite.png">  
             <p class="titulo">Barra de proteína - Chocolate ao Leite </p>
            <p class="preco verde">R$ 94,90 no PIX</p>
            <button>
               <a class="btn-comprar"
       href="../paginadoproduto.html?nome=Barra de proteína - Chocolate ao Leite&preco=94.90&img=imgbarrinha/chocolate ao leite.png&desc=Barra de proteína - Chocolate ao Leite">
        Comprar
    </a>
            </button>
        </div>
        

        <!-- Produto 3 -->
       <div class="card">
            <img src="../imgbarrinha/chocolate branco.png">  
             <p class="titulo">Barra de proteína - Chocolate Branco </p>
            <p class="preco verde">R$ 94,90 no PIX</p>
            <button>
               <a class="btn-comprar"
       href="../paginadoproduto.html?nome=Barra de proteína - Chocolate Branco&preco=94.90&img=imgbarrinha/chocolate branco.png&desc=Barra de proteína - Chocolate Branco">
        Comprar
    </a>
            </button>
        </div>

        <!-- Produto 4 -->
        <div class="card">
            <img src="../imgbarrinha/cookie.png">  
             <p class="titulo">Barra de proteína - Cookies </p>
            <p class="preco verde">R$ 94,90 no PIX</p>
            <button>
               <a class="btn-comprar"
       href="../paginadoproduto.html?nome=Barra de proteína - Cookies&preco=94.90&img=imgbarrinha/cookie.png&desc=Barra de proteína - Cookies">
        Comprar
    </a>
            </button>
        </div>

        <!-- Produto 5 -->
        <div class="card">
            <img src="../imgbarrinha/chocolate dark.png">  
             <p class="titulo">Barra de proteína - Chocolate Dark </p>
            <p class="preco verde">R$ 94,90 no PIX</p>
            <button>
               <a class="btn-comprar"
       href="../paginadoproduto.html?nome=Barra de proteína - Chocolate Dark&preco=94.90&img=imgbarrinha/chocolate dark.png&desc=Barra de proteína - Chocolate Dark">
        Comprar
    </a>
            </button>
        </div>

        <!-- Produto 6 -->
       <div class="card">
            <img src="../imgbarrinha/Banoffee.png">  
             <p class="titulo">Barra de proteína - Banoffee </p>
            <p class="preco verde">R$ 94,90 no PIX</p>
           <button>
               <a class="btn-comprar"
       href="../paginadoproduto.html?nome=Barra de proteína - Banoffee&preco=94.90&img=imgbarrinha/Banoffee.png&desc=Barra de proteína - Banoffee">
        Comprar
    </a>
            </button>
        </div>

        <!-- Produto 7 -->
        <div class="card">
            <img src="../imgbarrinha/frutas.png">  
             <p class="titulo">Barra de proteína - Frutas Vermelhas </p>
            <p class="preco verde">R$ 94,90 no PIX</p>
            <button>
               <a class="btn-comprar"
       href="../paginadoproduto.html?nome=Barra de proteína - Frutas Vermelhas&preco=94.90&img=imgbarrinha/frutas.png&desc=Barra de proteína - Frutas Vermelhas">
        Comprar
    </a>
            </button>
        </div>
        <!-- Produto 8 -->
       <div class="card">
            <img src="../imgbarrinha/avelã.png">  
             <p class="titulo">Barra de proteína - Avelã </p>
            <p class="preco verde">R$ 94,90 no PIX</p>
            <button>
               <a class="btn-comprar"
       href="../paginadoproduto.html?nome=Barra de proteína - Avelã &preco=94.90&img=imgbarrinha/avelã.png&desc=Barra de proteína - Avelã ">
        Comprar
    </a>
            </button>
        </div>

        <!-- Produto 9 -->
        <div class="card">
            <img src="../imgbarrinha/pistachelimao.png">  
             <p class="titulo">Barra de proteína - Pistache com Limão </p>
            <p class="preco verde">R$ 94,90 no PIX</p>
            <button>
               <a class="btn-comprar"
       href="../paginadoproduto.html?nome=Barra de proteína - Pistache com Limão- Avelã &preco=94.90&img=imgbarrinha/pistachelimao.png&desc=Barra de proteína - Pistache com Limão">
        Comprar
    </a>
            </button>
        </div>

        <div class="card">
            <img src="../imgbarrinha/café.png">  
             <p class="titulo">Barra de proteína - Café </p>
            <p class="preco verde">R$ 94,90 no PIX</p>
             <button>
               <a class="btn-comprar"
       href="../paginadoproduto.html?nome=Barra de proteína - Café&preco=94.90&img=imgbarrinha/café.png&desc=Barra de proteína - Café">
        Comprar
    </a>
            </button>
        </div>

    </section>

<p class="p">-</p>
    
<footer class="footer">
    <div class="footer-container">

        <div class="footer-col">
            <h3>Nutri&Treino</h3>
            <p>Saúde, bem-estar e alimentação equilibrada ao seu alcance.</p>
        </div>

        <div class="footer-col">
            <h4>Seções</h4>
            <ul>
                <li>consultas.htmlConsultas</a></li>
                <li><a href="treinos.htmlTreinos"></a></li>
                <li><a href= "htmlProdutos"></a></li>
                <li><a href= "htmlProdutos" ></a></li>
            </ul>
        </div>

        <div class="footer-col">
            <h4>Contato</h4>
            <ul>
                <li>📞 (19) 995225‑598</li>
                <li>📧 contato@nutrietreino.com</li>
            </ul>
        </div>

        <div class="footer-col">
            <h4>Siga-nos</h4>
            <div class="social">
                #📸</a>
                #📘</a>
                #▶️</a>
            </div>
        </div>

    </div>

    <div class="footer-copy">
        © 2026 Nutri&Treino — Todos os direitos reservados.
    </div>
</footer>

<!-- ===== PAINEL LATERAL ===== -->
   <form id="painel" class="painel" method="POST" action="../t_usuario/salvar_perfil.php">

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

    <button type="submit" class="btn-salvar">Salvar</button>

    <button type="button" class="btn-sair" onclick="window.location.href='logout.php'">
    Sair da conta
</button>

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
 </body>
 </html>