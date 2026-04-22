let tipoSelecionado = "";

/* ===== MAPA DE TIPOS PARA TAGS OSM ===== */
const tiposMap = {
  fitness_centre: ['leisure=fitness_centre', 'leisure=sports_centre'], 
  dance: ['leisure=fitness_centre', 'leisure=sports_centre'],           
  pilates: ['leisure=fitness_centre', 'leisure=sports_centre'],                        
  martial_arts: ['leisure=fitness_centre', 'leisure=sports_centre'] 
};

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
  const raio = 9000; // metros (9 km)
  const filtros = tiposMap[tipo];

  let query = `
    [out:json];
    (
  `;

  filtros.forEach(f => {
    query += `node[${f}](around:${raio},${lat},${lon});\n`;
    query += `way[${f}](around:${raio},${lat},${lon});\n`;
  });

  query += `
    );
    out tags center;
  `;

  const url =
    "https://overpass-api.de/api/interpreter?data=" +
    encodeURIComponent(query);

  document.getElementById("resultado").innerHTML =
    "<p>Buscando locais próximos de 9 km...</p>";

  fetch(url)
    .then(res => res.json())
    .then(data => mostrarResultados(data.elements, lat, lon))
    .catch(() => {
      document.getElementById("resultado").innerHTML =
        "<p>Erro ao buscar locais.</p>";
    });
}

/* ===== MOSTRAR RESULTADOS COM FILTRO POR NOME ===== */
function mostrarResultados(locais, latUser, lonUser) {
  const div = document.getElementById("resultado");
  div.innerHTML = "";

  if (!locais || locais.length === 0) {
    div.innerHTML = "<p>Nenhum local encontrado perto de você.</p>";
    return;
  }

  locais.forEach(local => {
    const tags = local.tags || {};
    const nome = tags.name;

    // filtro por nome dependendo do tipo
    if (tipoSelecionado === "pilates" && nome && !nome.toLowerCase().includes("pilates")) return;
    if (tipoSelecionado === "dance" && nome && !nome.toLowerCase().match(/dança|ballet|dance/)) return;
    if (tipoSelecionado === "martial_arts" && nome && !nome.toLowerCase().match(/jiu|karate|kung fu|taekwondo|muay thai|luta/)) return;

    const rua = tags["addr:street"] || "";
    const numero = tags["addr:housenumber"] || "";
    const bairro = tags["addr:neighbourhood"] || "";
    const cidade = tags["addr:city"] || "";

    if (!nome || (!rua && !cidade)) return;

    let endereco = `${rua} ${numero}`.trim();
    if (bairro) endereco += ` – ${bairro}`;
    if (cidade) endereco += `, ${cidade}`;

    // calcular distância aproximada
    const latLocal = local.lat || (local.center && local.center.lat);
    const lonLocal = local.lon || (local.center && local.center.lon);
    let distanciaTxt = "";
    if (latLocal && lonLocal) {
      const R = 6371000;
      const dLat = (latLocal - latUser) * Math.PI / 180;
      const dLon = (lonLocal - lonUser) * Math.PI / 180;
      const a = Math.sin(dLat/2) * Math.sin(dLat/2) +
                Math.cos(latUser * Math.PI/180) * Math.cos(latLocal * Math.PI/180) *
                Math.sin(dLon/2) * Math.sin(dLon/2);
      const c = 2 * Math.atan2(Math.sqrt(a), Math.sqrt(1-a));
      const distancia = R * c;
      distanciaTxt = distancia > 1000 
        ? ` (~${(distancia/1000).toFixed(1)} km)` 
        : ` (~${Math.round(distancia)} m)`;
    }

    const card = document.createElement("div");
    card.className = "card";
    card.innerHTML = `
      <h3>${nome}</h3>
      <p>📍 ${endereco}${distanciaTxt}</p>
    `;
    div.appendChild(card);
  });
}
