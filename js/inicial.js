function mostrarDetalhe(id) {
    // Esconde o conteúdo principal
    document.getElementById("conteudo-principal").style.display = "none";

    // Esconde todos os detalhes
    document.querySelectorAll(".produto-detalhe").forEach((d) => {
        d.style.display = "none";
    });

    // Mostra apenas o detalhe do produto selecionado
    const detalheSelecionado = document.querySelector(`#detalhe-produto-${id}`);
    if (detalheSelecionado) {
        detalheSelecionado.style.display = "block";
    } else {
        console.warn(`Detalhe do produto com ID ${id} não encontrado.`);
    }
}

function voltarParaHome() {
    // Mostra o conteúdo principal
    document.getElementById("conteudo-principal").style.display = "block";

    // Esconde todos os detalhes
    document.querySelectorAll(".produto-detalhe").forEach((d) => {
        d.style.display = "none";
    });
}
