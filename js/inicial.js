function mostrarDetalhe(id) {
    // Esconde o conteúdo principal
    document.getElementById("conteudo-principal").style.display = "none";

    // Esconde todos os detalhes
    document.querySelectorAll(".detalhe-produto").forEach(d => {
        d.style.display = "none";
    });

    // Mostra apenas o detalhe do produto selecionado
    const detalheSelecionado = document.getElementById("detalhe-produto-" + id);
    if (detalheSelecionado) {
        detalheSelecionado.style.display = "block";
    }
}

function voltarParaHome() {
    // Mostra o conteúdo principal
    document.getElementById("conteudo-principal").style.display = "block";

    // Esconde todos os detalhes
    document.querySelectorAll(".detalhe-produto").forEach(d => {
        d.style.display = "none";
    });
}