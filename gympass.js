let tipoSelecionado = "";

/* ===== SELEÇÃO DAS OPÇÕES ===== */
document.querySelectorAll(".opcao").forEach(opcao => {
  opcao.addEventListener("click", () => {
    document.querySelectorAll(".opcao")
      .forEach(o => o.classList.remove("ativa"));

    opcao.classList.add("ativa");
    tipoSelecionado = opcao.dataset.tipo;
  });
});

/* ===== BOTÃO BUSCAR ===== */
document.getElementById("buscar").addEventListener("click", () => {
  if (!tipoSelecionado) {
    alert("Escolha uma atividade primeiro!");
    return;
  }

  if (!navigator.geolocation) {
    alert("Seu navegador não suporta geolocalização.");
    return;
  }

  navigator.geolocation.getCurrentPosition(
    sucessoLocalizacao,
    erroLocalizacao,
    { enableHighAccuracy: true, timeout: 10000 }
  );
});

/* ===== SUCESSO GEOLOCALIZAÇÃO ===== */
function sucessoLocalizacao(pos) {
  const lat = pos.coords.latitude;
  const lon = pos.coords.longitude;
  buscarLocais(lat, lon, tipoSelecionado);
}

/* ===== ERRO GEOLOCALIZAÇÃO ===== */
function erroLocalizacao(err) {
  alert("Não foi possível obter sua localização. Verifique as permissões.");
}

/* ===== BUSCAR LOCAIS ===== */
function buscarLocais(lat, lon, tipo) {
  const raio = 3000; // metros

  const query = `
    [out:json];
    node
      ["sport"="${tipo}"]
      (around:${raio},${lat},${lon});
    out tags;
  `;

  const url =
    "https://overpass-api.de/api/interpreter?data=" +
    encodeURIComponent(query);

  document.getElementById("resultado").innerHTML =
    "<p>Buscando locais próximos...</p>";

  fetch(url)
    .then(res => res.json())
    .then(data => mostrarResultados(data.elements))
    .catch(() => {
      document.getElementById("resultado").innerHTML =
        "<p>Erro ao buscar locais.</p>";
    });
}

/* ===== MOSTRAR RESULTADOS COM ENDEREÇO ===== */
function mostrarResultados(locais) {
  const div = document.getElementById("resultado");
  div.innerHTML = "";

  if (!locais || locais.length === 0) {
    div.innerHTML = "<p>Nenhum local encontrado perto de você.</p>";
    return;
  }

  locais.forEach(local => {
    const tags = local.tags || {};

    const nome = tags.name || "Local sem nome";

    const rua = tags["addr:street"] || "";
    const numero = tags["addr:housenumber"] || "";
    const bairro = tags["addr:neighbourhood"] || "";
    const cidade = tags["addr:city"] || "";

    let endereco = "Endereço não informado";

    if (rua || cidade) {
      endereco = `${rua} ${numero}`.trim();
      if (bairro) endereco += ` – ${bairro}`;
      if (cidade) endereco += `, ${cidade}`;
    }

    const card = document.createElement("div");
    card.className = "card";

    card.innerHTML = `
      <h3>${nome}</h3>
      <p>📍 ${endereco}</p>
    `;

    div.appendChild(card);
  });
}
