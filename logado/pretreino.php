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
    <title>Pré-Treinos</title>
    <link rel="stylesheet" href="../css/styleswhey.css">
</head>
<body>

   <header class="site-header">
    <div class="topbar container">
     
       <a href="usuariologado.php">
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
     <a href="../carrinho.html" class="link-cesta" aria-label="Carrinho de compras">
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
</a>
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
            <img src="../imgpretreino/pre de abacaxi.jpeg">  
             <p class="titulo">Pré Treino - Abacaxi</p>
            <p class="preco verde">R$ 94,90 no PIX</p>
            <button>
               <a class="btn-comprar"
       href="../paginadoproduto.html?nome=Pré Treino - Abacaxi&preco=94.90&img=imgpretreino/pre de abacaxi.jpeg&desc=Pré Treino - Abacaxi">
        Comprar
    </a>
            </button>
        </div>

        <!-- Produto 2 -->
        <div class="card">
            <img src="../imgpretreino/pre de frutas.jpeg">  
             <p class="titulo">Pré Treino - Frutas Vermelhas </p>
            <p class="preco verde">R$ 94,90 no PIX</p>
            <button>
               <a class="btn-comprar"
       href="../paginadoproduto.html?nome=Pré Treino - Frutas Vermelhas&preco=94.90&img=imgpretreino/pre de frutas.jpeg&desc=Pré Treino - Frutas Vermelhas">
        Comprar
    </a>
            </button>
        </div>
        

        <!-- Produto 3 -->
       <div class="card">
            <img src="../imgpretreino/pre de limão.png">  
             <p class="titulo">Pré Treino - Limão Tropical </p>
            <p class="preco verde">R$ 94,90 no PIX</p>
           <button>
               <a class="btn-comprar"
       href="../paginadoproduto.html?nome=Pré Treino - Limão Tropical&preco=94.90&img=imgpretreino/pre de limão.png&desc=Pré Treino - Limão Tropical">
        Comprar
    </a>
            </button>
        </div>

        <!-- Produto 4 -->
        <div class="card">
            <img src="../imgpretreino/pre de melancia.png">  
             <p class="titulo">Pré Treino - Melancia </p>
            <p class="preco verde">R$ 94,90 no PIX</p>
            <button>
               <a class="btn-comprar"
       href="../paginadoproduto.html?nome=Pré Treino - Melancia&preco=94.90&img=imgpretreino/pre de melancia.png&desc=Pré Treino - Melancia">
        Comprar
    </a>
            </button>
        </div>

        <!-- Produto 5 -->
        <div class="card">
            <img src="../imgpretreino/pre laranja.png">  
             <p class="titulo">Pré Treino - Laranja</p>
            <p class="preco verde">R$ 94,90 no PIX</p>
          <button>
               <a class="btn-comprar"
       href="../paginadoproduto.html?nome=Pré Treino - Limão Tropical&preco=94.90&img=imgpretreino/pre laranja.png&desc=Pré Treino - Limão Tropical">
        Comprar
    </a>
            </button>
        </div>

        <!-- Produto 6 -->
       <div class="card">
            <img src="../imgpretreino/pre maça verde.png">  
             <p class="titulo">Pré Treino - Maça Verde</p>
            <p class="preco verde">R$ 94,90 no PIX</p>
            <button>
               <a class="btn-comprar"
       href="../paginadoproduto.html?nome=Pré Treino - Maça Verde&preco=94.90&img=imgpretreino/pre maça verde.png&desc=Pré Treino - Maça Verde">
        Comprar
    </a>
            </button>
        </div>

        <!-- Produto 7 -->
        <div class="card">
            <img src="../imgpretreino/pre uva.png">  
             <p class="titulo">Pré Treino - Uva</p>
            <p class="preco verde">R$ 94,90 no PIX</p>
            <button>
               <a class="btn-comprar"
       href="../paginadoproduto.html?nome=Pré Treino - Uva&preco=94.90&img=imgpretreino/pre uva.png&desc=Pré Treino - Uva">
        Comprar
    </a>
            </button>
        </div>
        <!-- Produto 8 -->
       <div class="card">
            <img src="../imgpretreino/pre morango.png">  
             <p class="titulo">Pré Treino - Morango</p>
            <p class="preco verde">R$ 94,90 no PIX</p>
            <button>
               <a class="btn-comprar"
       href="../paginadoproduto.html?nome=Pré Treino - Morango&preco=94.90&img=imgpretreino/pre morango.png&desc=Pré Treino - Morango">
        Comprar
    </a>
            </button>
        </div>

        <!-- Produto 9 -->
        <div class="card">
            <img src="../imgpretreino/pre kiwi.png">  
             <p class="titulo">Pré Treino - Kiwi</p>
            <p class="preco verde">R$ 94,90 no PIX</p>
            <button>
               <a class="btn-comprar"
       href="../paginadoproduto.html?nome=Pré Treino - Kiwi&preco=94.90&img=imgpretreino/pre kiwi.png&desc=Pré Treino - Kiwi">
        Comprar
    </a>
            </button>
        </div>

        <div class="card">
            <img src="../imgpretreino/pre caju.png">  
             <p class="titulo">Pré Treino - Caju</p>
            <p class="preco verde">R$ 94,90 no PIX</p>
            <button>
               <a class="btn-comprar"
       href="../paginadoproduto.html?nome=Pré Treino - Caju&preco=94.90&img=imgpretreino/pre caju.png&desc=Pré Treino - Caju">
        Comprar
    </a>
            </button>
        </div>

        <div class="card">
            <img src="../imgpretreino/pre açai.png">  
             <p class="titulo">Pré Treino - Açai</p>
            <p class="preco verde">R$ 94,90 no PIX</p>
           <button>
               <a class="btn-comprar"
       href="../paginadoproduto.html?nome=Pré Treino - Açai&preco=94.90&img=imgpretreino/pre açai.png&desc=Pré Treino - Açai">
        Comprar
    </a>
            </button>
        </div>

       <div class="card">
            <img src="../imgpretreino/pre cereja.png">  
             <p class="titulo">Pré Treino - Cereja</p>
            <p class="preco verde">R$ 94,90 no PIX</p>
            <button>
               <a class="btn-comprar"
       href="../paginadoproduto.html?nome=Pré Treino - Cereja&preco=94.90&img=imgpretreino/pre cereja.png&desc=Pré Treino - Cereja">
        Comprar
    </a>
            </button>
        </div>

        <div class="card">
            <img src="../imgpretreino/pre coco.png">  
             <p class="titulo">Pré Treino - Coco</p>
            <p class="preco verde">R$ 94,90 no PIX</p>
            <button>
               <a class="btn-comprar"
       href="../paginadoproduto.html?nome=Pré Treino - Coco&preco=94.90&img=imgpretreino/pre coco.png&desc=Pré Treino - Coco">
        Comprar
    </a>
            </button>
        </div>

        <div class="card">
            <img src="../imgpretreino/pre maracuja.png">  
             <p class="titulo">Pré Treino - Maracujá</p>
            <p class="preco verde">R$ 94,90 no PIX</p>
            <button>
               <a class="btn-comprar"
       href="../paginadoproduto.html?nome=Pré Treino - Maracujá&preco=94.90&img=imgpretreino/pre maracuja.png&desc=Pré Treino - Maracujá">
        Comprar
    </a>
            </button>
        </div>

        <div class="card">
            <img src="../imgpretreino/mix de frutas.jpeg">  
             <p class="titulo">Pré Treino - Mix de Frutas</p>
            <p class="preco verde">R$ 94,90 no PIX</p>
            <button>
               <a class="btn-comprar"
       href="../paginadoproduto.html?nome=Pré Treino - Mix de Frutas&preco=94.90&img=imgpretreino/mix de frutas.jpeg&desc=Pré Treino - Mix de Frutas">
        Comprar
    </a>
            </button>
        </div>


        <div class="card">
            <img src="../imgpretreino/mix.jpeg">  
             <p class="titulo">Pré Treino - Mix de Frutas</p>
            <p class="preco verde">R$ 94,90 no PIX</p>
            <button>
               <a class="btn-comprar"href="../paginadoproduto.html?nome=Pré Treino - Mix de Frutas&preco=94.90&img=imgpretreino/mix.jpeg&desc=Pré Treino - Mix de Frutas">
        Comprar
    </a>
            </button>
        </div>

        <div class="card">
            <img src="../imgpretreino/mixs.jpeg">  
             <p class="titulo">Pré Treino - Mix de Frutas</p>
            <p class="preco verde">R$ 94,90 no PIX</p>
            <button>
               <a class="btn-comprar"
       href="../paginadoproduto.html?nome=Pré Treino - Mix de Frutas&preco=94.90&img=imgpretreino/mixs.jpeg&desc=Pré Treino - Mix de Frutas">
        Comprar
    </a>
            </button>
        </div>

        <div class="card">
            <img src="../imgpretreino/pitaya.jpeg">  
             <p class="titulo">Pré Treino - Pitaya</p>
            <p class="preco verde">R$ 94,90 no PIX</p>
            <button>
               <a class="btn-comprar"
       href="../paginadoproduto.html?nome=Pré Treino - Pitaya&preco=94.90&img=imgpretreino/pitaya.jpeg&desc=Pré Treino - Pitaya">
        Comprar
    </a>
            </button>
        </div>

        <div class="card">
            <img src="../imgpretreino/melancia.jpeg">  
             <p class="titulo">Pré Treino - Mix de Frutas</p>
            <p class="preco verde">R$ 94,90 no PIX</p>
            <button>
               <a class="btn-comprar"
       href="../paginadoproduto.html?nome=Mix de Frutas&preco=94.90&img=imgpretreino/melancia.jpeg&desc=Mix de Frutas">
        Comprar
    </a>
            </button>
        </div>

        <div class="card">
            <img src="../imgpretreino/pessego.png">  
             <p class="titulo">Pré Treino - Pêssego</p>
            <p class="preco verde">R$ 94,90 no PIX</p>
         <button>
               <a class="btn-comprar"
       href="../paginadoproduto.html?nome=Pré Treino - Pêssego&preco=94.90&img=imgpretreino/pessego.png&desc=Pré Treino - Pêssego">
        Comprar
    </a>
            </button>>
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
</body>
</html>