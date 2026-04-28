
  const dias = [
    "segunda", "terca", "quarta",
    "quinta", "sexta", "sabado", "domingo"
  ];

  // Carregar automaticamente ao abrir a página
dias.forEach(dia => {
  const campo = document.getElementById(dia);
  if (campo) {
    campo.value = localStorage.getItem(dia) || "";
  }
});

  // Salvar ao clicar no botão
  function salvarTreinos() {
    dias.forEach(dia => {
      const valor = document.getElementById(dia).value;
      localStorage.setItem(dia, valor);
    });

    alert("Treinos salvos com sucesso!");
  }

  //Limpar ao clicar 

function limparTreinos() {
  if (confirm("Tem certeza que deseja limpar todos os treinos?")) {
    dias.forEach(dia => {
      document.getElementById(dia).value = "";
      localStorage.removeItem(dia);
    });
  }
}

let diaSelecionado = null;

function definirDia(dia) {
  diaSelecionado = dia;

  document.querySelectorAll(".planner .dia").forEach(card => {
    card.classList.remove("ativo");
  });

  const textarea = document.getElementById(dia);
  if (!textarea) return;

  const cardAtivo = textarea.closest(".dia");
  if (cardAtivo) {
    cardAtivo.classList.add("ativo");
  }
}


function abrirMenu() {
  document.getElementById("menu-treinos").classList.add("aberto");
}

function fecharMenu() {
  document.getElementById("menu-treinos").classList.remove("aberto");
}

function usarTreino(treino) {
  if (!diaSelecionado) {
    alert("Selecione um dia primeiro.");
    return;
  }

  document.getElementById(diaSelecionado).value = treino;
  fecharMenu();
}



function selecionarTipo(tipo) {
  document.getElementById("treinos-feminino").classList.add("hidden");
  document.getElementById("treinos-masculino").classList.add("hidden");

  if (tipo === "feminino") {
    document.getElementById("treinos-feminino").classList.remove("hidden");
  } else {
    document.getElementById("treinos-masculino").classList.remove("hidden");
  }
}

/* Treinos prontos */
const treinosFemininos = {
  posterior: "Treino A: Posterior + Glúteo\n- Levantamento terra romeno – 4x8-10\n- Mesa flexora – 3x10-12\n- Elevação pélvica (hip thrust) – 4x8-12\n- Glúteo no cabo – 3x12\n- Abdução máquina – 3x12-15",
  superior: "Treino B: Superior completo\n- Puxada na frente – 3x8-12\n- Remada baixa – 3x10-12\n- Supino com halter – 3x8-10\n- Elevação lateral – 3x12\n- Rosca direta – 3x10\n- Tríceps corda – 3x10-12",
  quadríceps: "Treino C: Quadríceps\n- Agachamento livre – 4x6-10\n- Leg press – 3x8-12\n- Cadeira extensora – 4x10-12\n- Afundo (lunge) – 3x10 cada perna",
  perna: "Treino D: Perna completo\n- Agachamento sumô – 4x8-10\n- Stiff – 3x8-10\n- Mesa flexora – 3x10-12\n- Cadeira extensora – 3x10-12\n- Elevação pélvica – 3x10-12\n- Panturrilha – 4x12-15",
  cardio: "Treino E: Cardio\n- Cardio 30-40 minutos",
};

const treinosMasculinos = {
  peito: "Treino A: Peito + Bíceps:\n- Supino reto com barra – 4x6-10\n- Supino inclinado com halter – 3x8-12\n- Crucifixo máquina ou cabo – 3x10-12\n- Paralelas (foco no peito) – 3x até falha\n- Rosca direta barra – 4x8-10\n- Rosca alternada halter – 3x10-12\n- Rosca concentrada – 3x10-12",
  costas: "Treino B: Costas:\n- Barra fixa – 4x até falha\n- Puxada na frente (pulldown) – 3x8-12\n- Remada curvada barra – 4x8-10\n- Remada baixa – 3x10-12\n- Pullover na máquina/cabo – 3x10-12\n- Opcional: encolhimento pra trapézio – 3x12",
  biceps: "Treino C: Pernas completo:\n- Agachamento livre – 4x6-10\n- Leg press – 3x8-12\n- Cadeira extensora – 3x10-12\n- Mesa flexora – 3x10-12\n- Stiff – 3x8-10\n- Panturrilha em pé – 4x12-15 " ,
  ombro: "Treino D: Ombro + Tríceps:\n- Desenvolvimento com halter – 4x8-10\n- Elevação lateral – 3x10-12\n- Elevação frontal – 3x10-12\n- Crucifixo inverso (posterior) – 3x12\n- Tríceps testa – 3x8-10\n- Tríceps corda – 3x10-12\n- Mergulho banco – 3x até falha",
  cardio: "Treino E: Cardio\n- Cardio 30-40 minutos",
};