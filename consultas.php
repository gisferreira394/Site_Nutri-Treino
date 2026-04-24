<?php
session_start();
include "includes/conexao.php";

$usuario_id = $_SESSION["usuario_id"];

// busca dados físicos
$sql = "SELECT * FROM dados_fisicos WHERE usuario_id = $usuario_id";
$res = mysqli_query($conexao, $sql);
$dados = mysqli_fetch_assoc($res);
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
<meta charset="UTF-8">
<title>Plano Nutricional Semanal</title>

<style>
body {
    font-family: Arial;
    background: #f4f4f9;
    padding: 20px;
}

.container {
    max-width: 700px;
    margin: auto;
    background: #fff;
    padding: 25px;
    border-radius: 8px;
    position: relative;
}

h2 {
    text-align: center; /* centraliza o título */
    margin: 0;
}

.seta {
    position: absolute;
    top: 10px;
    left: 10px;
    font-size: 24px;
    cursor: pointer;
    text-decoration: none;
    color: #333;
}
.seta:hover {
    color: #4CAF50;
}

/* Padronização dos campos */
input, select, button {
    display: block;
    width: 100%;
    box-sizing: border-box; /* garante que padding não quebre o tamanho */
    padding: 12px;
    margin-top: 12px;
    border: 1px solid #ccc;
    border-radius: 5px;
}

button {
    background: #4CAF50;
    color: white;
    border: none;
    cursor: pointer;
    font-weight: bold;
    padding: 10px 20px;   /* reduz o tamanho interno */
    width: 200px;         /* largura fixa menor */
    margin: 15px auto;    /* centraliza horizontalmente */
    display: block;       /* garante alinhamento */
    border-radius: 5px;
}

button:hover {
    background: #45a049;
}

.resultado {
    margin-top: 20px;
    padding: 15px;
    background: #c8f7c5;
    border-radius: 5px;
}
</style>
</head>

<body>

<div class="container">

<!-- Seta para voltar -->
<a href="#" class="seta" onclick="history.back()">&#8592;</a>

<h2>Plano Nutricional Semanal</h2>

<input type="number" id="peso" value="<?php echo $dados['peso'] ?? ''; ?>" readonly>
<input type="number" id="altura" value="<?php echo $dados['altura'] ?? ''; ?>" readonly>
<input type="number" id="idade" value="<?php echo $dados['idade'] ?? ''; ?>" readonly>

<select id="sexo" disabled>
    <option value="M" <?php if(($dados['genero'] ?? '') == "Masculino") echo "selected"; ?>>Masculino</option>
    
    <option value="F" <?php if(($dados['genero'] ?? '') == "Feminino") echo "selected"; ?>>Feminino</option>
</select>

<select id="objetivo">
    <option value="ganhar">Ganhar peso</option>
    <option value="manter">Manter peso</option>
    <option value="emagrecer">Emagrecer</option>
</select>

<button onclick="gerarPlano()">Gerar Plano</button>

<div class="resultado" id="resultado"></div>
<div class="resultado" id="plano"></div>

</div>

<script>
// ===== CÁLCULOS =====
function calcularTMB(peso, altura, idade, sexo) {
    return sexo === "M"
        ? 88.36 + (13.4 * peso) + (4.8 * altura) - (5.7 * idade)
        : 447.6 + (9.2 * peso) + (3.1 * altura) - (4.3 * idade);
}

function ajustarCalorias(tmb, objetivo) {
    if (objetivo === "ganhar") return tmb * 1.15;
    if (objetivo === "emagrecer") return tmb * 0.80;
    return tmb;
}

function calcularMacros(calorias) {
    return {
        carb: (calorias * 0.50) / 4,
        prot: (calorias * 0.25) / 4,
        gord: (calorias * 0.25) / 9
    };
}

function calcularAgua(peso) {
    return (peso * 35) / 1000;
}

// ===== PLANO SEMANAL =====
function escolher(lista) {
    return lista[Math.floor(Math.random() * lista.length)];
}

function montarPlanoSemanal(objetivo) {
    let alimentos = {
        cafe: [
            "2 ovos mexidos + pão integral + banana",
            "Iogurte natural + aveia + morango",
            "Tapioca com queijo branco + mamão",
            "Vitamina de banana com leite + aveia",
            "Pão integral + pasta de amendoim + maçã",
            "Omelete com queijo + fruta",
            "Cuscuz com ovo + queijo branco"
        ],
        almoco: [
            "Arroz + feijão + frango grelhado + salada",
            "Arroz integral + carne magra + brócolis",
            "Macarrão integral + frango desfiado + salada",
            "Batata-doce + carne moída + legumes",
            "Arroz + peixe grelhado + salada",
            "Purê de batata + frango + cenoura",
            "Arroz integral + carne + abobrinha + salada"
        ],
        lanche: [
            "Iogurte + banana + aveia",
            "Pão integral com ovo",
            "Vitamina de frutas com whey",
            "Castanhas + maçã",
            "Sanduíche natural de frango",
            "Queijo branco + fruta",
            "Iogurte + granola"
        ],
        jantar: [
            "Frango grelhado + legumes + salada",
            "Omelete com legumes",
            "Peixe assado + batata-doce",
            "Sopa de legumes com frango",
            "Carne magra + salada + legumes",
            "Frango desfiado + abobrinha + cenoura",
            "Ovos mexidos + salada"
        ]
    };

    if (objetivo === "emagrecer") {
        alimentos.lanche = [
            "Iogurte natural + fruta",
            "Ovo cozido + fruta",
            "Castanhas + chá",
            "Queijo branco + fruta"
        ];
        alimentos.jantar = [
            "Frango + salada",
            "Omelete leve",
            "Peixe + legumes",
            "Sopa leve"
        ];
    }

    if (objetivo === "ganhar") {
        alimentos.cafe.push("Pão + ovos + vitamina + aveia");
        alimentos.lanche.push("Sanduíche + vitamina + banana");
    }

    const dias = ["Segunda","Terça","Quarta","Quinta","Sexta","Sábado","Domingo"];
    let semana = {};

    dias.forEach(dia => {
        semana[dia] = {
            "Café da manhã": escolher(alimentos.cafe),
            "Almoço": escolher(alimentos.almoco),
            "Lanche da tarde": escolher(alimentos.lanche),
            "Jantar": escolher(alimentos.jantar)
        };
    });

    return semana;
}

// ===== FUNÇÃO PRINCIPAL =====
function gerarPlano() {
    let peso = parseFloat(document.getElementById("peso").value);
    let altura = parseFloat(document.getElementById("altura").value);
    let idade = parseInt(document.getElementById("idade").value);
    let sexo = document.getElementById("sexo").value;
    let objetivo = document.getElementById("objetivo").value;

    if (!peso || !altura || !idade) {
        alert("Preencha todos os campos!");
        return;
    }

    let tmb = calcularTMB(peso, altura, idade, sexo);
    let calorias = ajustarCalorias(tmb, objetivo);
    let macros = calcularMacros(calorias);
    let agua = calcularAgua(peso);
    let semana = montarPlanoSemanal(objetivo);

    document.getElementById("resultado").innerHTML = `
        <strong>Resultados (${objetivo}):</strong><br><br>
        🔥 TMB: ${tmb.toFixed(0)} kcal/dia<br>
        ⚡ Calorias ajustadas: ${calorias.toFixed(0)} kcal/dia<br><br>
        🍗 Proteína: ${macros.prot.toFixed(1)} g/dia<br>
        🍞 Carboidrato: ${macros.carb.toFixed(1)} g/dia<br>
        🥑 Gordura: ${macros.gord.toFixed(1)} g/dia<br><br>
        💧 Água: ${agua.toFixed(2)} L/dia
    `;

    let html = `<strong>Plano alimentar semanal:</strong><br><br>`;
    for (let dia in semana) {
        html += `<strong>${dia}</strong><br>`;
        for (let ref in semana[dia]) {
            html += `${ref}: ${semana[dia][ref]}<br>`;
        }
        html += `<br>`;
    }
    document.getElementById("plano").innerHTML = html;
}
</script>

</body>
</html>
