
  const dias = [
    "segunda", "terca", "quarta",
    "quinta", "sexta", "sabado", "domingo"
  ];

  // Carregar automaticamente ao abrir a página
  dias.forEach(dia => {
    const campo = document.getElementById(dia);
    campo.value = localStorage.getItem(dia) || "";
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


