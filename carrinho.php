<?php
session_start();

if (!isset($_SESSION["usuario_id"])) {
    // não está logado
    $naoLogado = true;
} else {
    $naoLogado = false;

    include "includes/conexao.php";

    $usuario_id = $_SESSION["usuario_id"];

    $sql = "SELECT * FROM dados_fisicos WHERE usuario_id = $usuario_id";
    $res = mysqli_query($conexao, $sql);
    $dados = mysqli_fetch_assoc($res);
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<title>Carrinho</title>

<style>
body {
    font-family: Arial, sans-serif;
    background: #f5f5f5;
    margin: 0;
}

/* HEADER */
header {
    background: #387856;
    color: white;
    padding: 15px;
    text-align: center;
    font-size: 22px;
    font-weight: bold;
}

/* LISTA */
#lista {
    max-width: 900px;
    margin: 20px auto;
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(260px, 1fr));
    gap: 15px;
}

/* CARD */
.card {
    background: white;
    border-radius: 12px;
    overflow: hidden;
    box-shadow: 0 4px 10px rgba(0,0,0,0.1);
}

.card img {
    width: 100%;
    height: 150px;
    object-fit: cover;
}

.conteudo {
    padding: 12px;
    text-align: center;
}

.nome {
    font-weight: bold;
}

.preco {
    color: #4CAF50;
}

.remover {
    background: #f44336;
    color: white;
    border: none;
    padding: 8px;
    border-radius: 6px;
    cursor: pointer;
}

/* ===== PAINEL ===== */
.painel {
    max-width: 900px;
    margin: 20px auto;
}

/* ===== BOX PADRÃO ===== */
.box {
    background: white;
    padding: 20px;
    border-radius: 12px;
    margin-bottom: 15px;
    box-shadow: 0 4px 10px rgba(0,0,0,0.1);
}

/* ===== FRETE ===== */
.frete-input {
    display: flex;
    gap: 10px;
    margin-top: 10px;
}

.frete-input input {
    flex: 1;
    padding: 10px;
    border-radius: 8px;
    border: 1px solid #ccc;
}

.frete-input button {
    background: #4CAF50;
    color: white;
    border: none;
    padding: 10px 14px;
    border-radius: 8px;
    cursor: pointer;
}

.frete-input button:hover {
    background: #388e3c;
}

.prazo {
    font-size: 14px;
    color: #666;
}

/* ===== CUPOM ===== */
.cupom-box input {
    width: 100%;
    padding: 10px;
    margin-top: 10px;
    border-radius: 8px;
    border: 1px solid #ccc;
}

.cupom-box button {
    margin-top: 10px;
    width: 100%;
    padding: 10px;
    background: #ff9800;
    border: none;
    color: white;
    border-radius: 8px;
}

/* ===== PAGAMENTO ===== */
select {
    width: 100%;
    padding: 10px;
    margin-top: 10px;
    border-radius: 8px;
}

/* ===== TOTAL ===== */
.total-box {
    font-size: 20px;
    font-weight: bold;
    text-align: right;
}

/* BOTÃO FINAL */
.finalizar {
    width: 100%;
    background: #387856;
    color: white;
    padding: 15px;
    border: none;
    font-size: 18px;
    border-radius: 10px;
    margin-top: 10px;
    cursor: pointer;
}
/* ===== STATUS DO PEDIDO ===== */
.status-box {
    max-width: 900px;
    margin: 20px auto;
    background: #e8f5e9;
    border-left: 6px solid #387856;
    padding: 20px;
    border-radius: 10px;
}

.status-box h3 {
    margin-top: 0;
    color: #387856;
}

.status-box .linha {
    margin: 6px 0;
}

.status-confirmado {
    font-weight: bold;
    color: #387856;
}

.login-alert {
    width: 90%;        /* ocupa mais da tela no celular */
    max-width: 400px;  /* limite no desktop */
    margin: 80px auto; /* menos espaço em cima */
    padding: 30px;
    text-align: center;

    background: white;
    border-radius: 12px;
    box-shadow: 0 5px 20px rgba(0,0,0,0.1);
}

.login-alert h2 {
    margin-bottom: 10px;
}

.login-alert p {
    margin-bottom: 20px;
    color: #555;
}

.btn-login {
    display: inline-block;
    padding: 10px 20px;
    background: #4c5fd5;
    color: white;
    border-radius: 8px;
    text-decoration: none;
}

</style>

</head>

<body>

<?php if ($naoLogado): ?>

<div class="login-alert">
    <h2>🔒 Acesso restrito</h2>
    <p>Você precisa estar logado para acessar essa página.</p>
    
    <a href="login.php" class="btn-login">Fazer login</a>
</div>

<?php else: ?>

<header>Meu Carrinho</header>

<!-- STATUS DO PEDIDO -->
<div id="statusPedido"></div>

<div id="lista"></div>
<div id="lista"></div>

<div class="painel">

    <!-- FRETE -->
    <div class="box">
        <h3>🚚 Calcular Frete</h3>

        <div class="frete-input">
            <input type="text" id="cep" placeholder="Digite seu CEP">
            <button onclick="calcularFrete()">🔍</button>
        </div>

        <p id="freteValor">Frete: R$ 0.00</p>
        <p class="prazo" id="prazoEntrega"></p>
    </div>

    <!-- CUPOM -->
    <div class="box cupom-box">
        <h3>🎟 Cupom</h3>
        <input type="text" id="cupom" placeholder="Digite o cupom">
        <button onclick="aplicarCupom()">Aplicar Cupom</button>
        <p id="desconto">Desconto: R$ 0.00</p>
    </div>

    <!-- PAGAMENTO -->
    <div class="box">
        <h3>💳 Pagamento</h3>
        <select id="pagamento">
            <option value="credito">Cartão de Crédito</option>
            <option value="debito">Cartão de Débito</option>
            <option value="pix">PIX</option>
            <option value="boleto">Boleto</option>
        </select>
    </div>

    <!-- TOTAL -->
    <div class="box total-box">
        <span id="total">Total: R$ 0.00</span>
    </div>

    <button href="pagamento.html" class="finalizar"  onclick="finalizarCompra()">
        Finalizar Compra
    </button>

</div>

<script>
let carrinho = JSON.parse(localStorage.getItem("carrinho")) || [];

let frete = 0;
let desconto = 0;

/* RENDER */
function renderizarCarrinho() {
    let lista = document.getElementById("lista");
    lista.innerHTML = "";

    let subtotal = 0;

    carrinho.forEach((p, index) => {
        let preco = parseFloat(p.preco) || 0;
        let qtd = parseInt(p.quantidade) || 1;

        subtotal += preco * qtd;

        lista.innerHTML += `
            <div class="card">
                <img src="${p.imagem}">
                <div class="conteudo">
                    <div class="nome">${p.nome}</div>
                    <div class="preco">R$ ${preco.toFixed(2)}</div>
                    <div>Qtd: ${qtd}</div>
                    <button class="remover" onclick="removerItem(${index})">Remover</button>
                </div>
            </div>
        `;
    });

    atualizarTotal(subtotal);
}

/* TOTAL */
function atualizarTotal(subtotal) {

    if (subtotal >= 150) {
        frete = 0;
        document.getElementById("freteValor").innerText = "Frete: GRÁTIS 🎉";
    }

    let total = subtotal + frete - desconto;

    document.getElementById("total").innerText =
        "Total: R$ " + total.toFixed(2);
}

/* REMOVER */
function removerItem(index) {
    carrinho.splice(index, 1);
    localStorage.setItem("carrinho", JSON.stringify(carrinho));
    renderizarCarrinho();
}

/* CALCULAR SUBTOTAL */
function calcularSubtotal() {
    let subtotal = 0;

    carrinho.forEach(p => {
        let preco = parseFloat(p.preco) || 0;
        let qtd = parseInt(p.quantidade) || 1;
        subtotal += preco * qtd;
    });

    return subtotal;
}

/* FRETE */
function calcularFrete() {
    const cep = document.getElementById("cep").value;

    if (cep.length < 8) {
        alert("Digite um CEP válido");
        return;
    }

    let subtotal = calcularSubtotal();

    if (subtotal >= 150) {
        frete = 0;
        document.getElementById("freteValor").innerText = "Frete: GRÁTIS 🎉";
        document.getElementById("prazoEntrega").innerText = "Entrega: 2 a 4 dias";
    } else if (cep.startsWith("13")) {
        frete = 10;
        document.getElementById("prazoEntrega").innerText = "Entrega: 1 a 3 dias";
    } else if (cep.startsWith("01")) {
        frete = 20;
        document.getElementById("prazoEntrega").innerText = "Entrega: 2 a 4 dias";
    } else {
        frete = 30;
        document.getElementById("prazoEntrega").innerText = "Entrega: 3 a 7 dias";
    }

    document.getElementById("freteValor").innerText =
        "Frete: R$ " + frete.toFixed(2);

    renderizarCarrinho();
}

/* CUPOM */
function aplicarCupom() {
    const cupom = document.getElementById("cupom").value.toUpperCase();

    if (cupom === "DESCONTO10") {
        desconto = 10;
    } else if (cupom === "PRIMEIRACOMPRA") {
        desconto = 20;
    } else {
        desconto = 0;
        alert("Cupom inválido");
    }

    document.getElementById("desconto").innerText =
        "Desconto: R$ " + desconto.toFixed(2);

    renderizarCarrinho();
}

/* FINALIZAR */
function finalizarCompra() {
    if (carrinho.length === 0) {
        alert("Carrinho vazio!");
        return;
    }

    const pagamento = document.getElementById("pagamento").value;

    // calcular total final
    const subtotal = calcularSubtotal();
    const totalFinal = subtotal + frete - desconto;

    // salvar infos para a próxima página
    localStorage.setItem("totalPix", totalFinal.toFixed(2));

    if (pagamento === "pix") {
        window.location.href = "pagamento-pix.html";
        return;
    }

    alert("Compra finalizada via " + pagamento + " 🎉");

    localStorage.removeItem("carrinho");
    carrinho = [];

}
renderizarCarrinho();

function mostrarStatusPedido() {

    const pedidos = JSON.parse(localStorage.getItem("pedidos")) || [];

    if (pedidos.length === 0) return;

    // pegar o último pedido
    const pedido = pedidos[pedidos.length - 1];

    const div = document.getElementById("statusPedido");

    div.innerHTML = `
        <div class="status-box">
            <h3>📦 Status do Pedido</h3>
            <div class="linha"><strong>Pedido:</strong> ${pedido.id}</div>
            <div class="linha"><strong>Data:</strong> ${pedido.data}</div>
            <div class="linha"><strong>Total:</strong> R$ ${pedido.total}</div>
            <div class="linha status-confirmado">
                Status: ${pedido.status}
            </div>
        </div>
    `;
}

renderizarCarrinho();
mostrarStatusPedido();
</script>



</body>
</html>
<?php endif; ?>