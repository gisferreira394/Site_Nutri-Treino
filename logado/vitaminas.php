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
    <title>Vitaminas</title>
    <link rel="stylesheet" href="../css/styleswhey.css">
</head>
<body>

   <header class="site-header">
    <div class="topbar container">
     
       <a href="usuariologado.php" class="logo-link">
    <img src="../img/logonutri.png" alt="Logo" class="logo">
</a>

      <form class="search" onsubmit="return buscarProduto(event)">
  <input type="search" id="campoBusca" placeholder="Buscar" aria-label="Buscar" autocomplete="off" />
  <button type="submit" aria-label="Pesquisar">
    🔍
  </button>
  <!-- lista de sugestões -->
  <ul id="sugestoes" class="sugestoes"></ul>
</form>

<style>
.search {
  position: relative;
  display: flex;
  align-items: center;
  width: 250px;
  background: #fff;
  border: 1px solid #ccc;
  border-radius: 20px;
  /* remova overflow:hidden daqui */
}

.search input {
  flex: 1;
  border: none;
  outline: none;
  font-size: 14px;
  padding: 6px 10px;
  background: transparent;
}

.search button {
  border: none;
  outline: none;
  background: white; /* cinza claro */
  padding: 6px 12px;
  cursor: pointer;
  border-radius: 0 20px 20px 0; /* arredonda só o lado direito */
}



.sugestoes {
  color: black;
  list-style: none;
  margin: 0;
  padding: 0;
  position: absolute;
  top: 100%;       /* aparece logo abaixo do campo */
  left: 0;
  right: 0;
  background: #fff;
  border: 1px solid #ccc;
  border-top: none; /* evita linha dupla com o campo */
  border-radius: 0 0 10px 10px; /* arredonda só embaixo */
  z-index: 999;    /* garante que fique por cima */
}

.sugestoes li {
  padding: 8px;
  cursor: pointer;
}

.sugestoes li:hover {
  background: #f0f0f0;
}

</style>

<script>
  // produtos simulados
  const produtos = [
    { nome: "Whey Protein", url: "whey.php" },
    { nome: "Creatina", url: "creatina.php" },
    { nome: "vitaminas", url: "vitaminas.php" },
    { nome: "Pré-treino", url: "pretreino.php" },
    { nome: "barrinhas", url: "barrinhas.php" }
  ];

  const campoBusca = document.getElementById("campoBusca");
  const listaSugestoes = document.getElementById("sugestoes");

  campoBusca.addEventListener("input", function() {
    const termo = this.value.toLowerCase();
    listaSugestoes.innerHTML = "";

    if (termo.length > 0) {
      const filtrados = produtos.filter(p => p.nome.toLowerCase().includes(termo));
      filtrados.forEach(p => {
        const li = document.createElement("li");
        li.textContent = p.nome;
        li.addEventListener("click", () => {
          window.location.href = p.url; // redireciona ao clicar
        });
        listaSugestoes.appendChild(li);
      });
    }
  });

  function buscarProduto(event) {
    event.preventDefault();
    const termo = campoBusca.value.toLowerCase();
    const produto = produtos.find(p => p.nome.toLowerCase().includes(termo));
    if (produto) {
      window.location.href = produto.url;
    } else {
      alert("Produto não encontrado!");
    }
  }
</script>

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
            <img src="../imgvitamina/vitaminaA.png">  
             <p class="titulo">Vitamina A</p>
            <p class="preco verde">R$ 94,90 no PIX</p>
            <button>
               <a class="btn-comprar"
       href="../paginadoproduto.html?nome=Vitamina A&preco=94.90&img=imgvitamina/vitaminaA.png&desc=Vitamina A">
        Comprar
    </a>
            </button>
        </div>

        <!-- Produto 2 -->
        <div class="card">
            <img src="../imgvitamina/vitaminab1.jpeg">  
             <p class="titulo">Vitamina B1</p>
            <p class="preco verde">R$ 94,90 no PIX</p>
            <button>
               <a class="btn-comprar"
       href="../paginadoproduto.html?nome=Vitamina B1&preco=94.90&img=imgvitamina/vitaminab1.jpeg&desc=Vitamina B1">
        Comprar
    </a>
            </button>
        </div>
        

        <!-- Produto 3 -->
       <div class="card">
            <img src="../imgvitamina/vitaminab12.jpeg">  
             <p class="titulo">Vitamina B12</p>
            <p class="preco verde">R$ 94,90 no PIX</p>
           <button>
               <a class="btn-comprar"
       href="../paginadoproduto.html?nome=Vitamina B12&preco=94.90&img=imgvitamina/vitaminab12.jpeg&desc=Vitamina B12">
        Comprar
    </a>
            </button>
        </div>

        <!-- Produto 4 -->
        <div class="card">
            <img src="../imgvitamina/vitaminab6.jpeg">  
             <p class="titulo">Vitamina B6</p>
            <p class="preco verde">R$ 94,90 no PIX</p>
             <button>
               <a class="btn-comprar"
       href="../paginadoproduto.html?nome=Vitamina B6&preco=94.90&img=imgvitamina/vitaminab6.jpeg&desc=Vitamina B6">
        Comprar
    </a>
            </button>
        </div>

        <!-- Produto 5 -->
        <div class="card">
            <img src="../imgvitamina/vitaminac.jpeg">  
             <p class="titulo">Vitamina C</p>
            <p class="preco verde">R$ 94,90 no PIX</p>
             <button>
               <a class="btn-comprar"
       href="../paginadoproduto.html?nome=Vitamina C&preco=94.90&img=imgvitamina/vitaminac.jpeg&desc=Vitamina C">
        Comprar
    </a>
            </button>
        </div>

        <!-- Produto 6 -->
       <div class="card">
            <img src="../imgvitamina/vitaminad.jpeg">  
             <p class="titulo">Vitamina D</p>
            <p class="preco verde">R$ 94,90 no PIX</p>
             <button>
               <a class="btn-comprar"
       href="../paginadoproduto.html?nome=Vitamina D&preco=94.90&img=imgvitamina/vitaminad.jpeg&desc=Vitamina D">
        Comprar
    </a>
            </button>
        </div>

        <!-- Produto 7 -->
        <div class="card">
            <img src="../imgvitamina/vitaminae.jpeg">  
             <p class="titulo">Vitamina E</p>
            <p class="preco verde">R$ 94,90 no PIX</p>
            <button>
               <a class="btn-comprar"
       href="../paginadoproduto.html?nome=Vitamina E&preco=94.90&img=imgvitamina/vitaminae.jpeg&desc=Vitamina E">
        Comprar
    </a>
            </button>
        </div>
        <!-- Produto 8 -->
       <div class="card">
            <img src="../imgvitamina/vitaminak.jpeg">  
             <p class="titulo">Vitamina K</p>
            <p class="preco verde">R$ 94,90 no PIX</p>
            <button>
               <a class="btn-comprar"
       href="../paginadoproduto.html?nome=Vitamina K&preco=94.90&img=imgvitamina/vitaminak.jpeg&desc=Vitamina K">
        Comprar
    </a>
            </button>
        </div>

        <!-- Produto 9 -->
        <div class="card">
            <img src="../imgvitamina/vitaminamulti.jpeg">  
             <p class="titulo">Vitamina Multivitamínico</p>
            <p class="preco verde">R$ 94,90 no PIX</p>
            <button>
               <a class="btn-comprar"
       href="../paginadoproduto.html?nome=Vitamina Multivitamínico&preco=94.90&img=imgvitamina/vitaminamulti.jpeg&desc=Vitamina Multivitamínico">
        Comprar
    </a>
            </button>
        </div>

        <div class="card">
            <img src="../imgvitamina/vitaminaomega3.jpeg">  
             <p class="titulo">Vitamina Ômega 3</p>
            <p class="preco verde">R$ 94,90 no PIX</p>
            <button>
               <a class="btn-comprar"
       href="../paginadoproduto.html?nome=Vitamina Ômega 3&preco=94.90&img=imgvitamina/vitaminaomega3.jpeg&desc=Vitamina Ômega 3">
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