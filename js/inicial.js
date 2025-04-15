function mostrarDetalhe(id) {
    // Esconde o conteúdo principal
    document.getElementById("conteudo-principal").style.display = "none";

    // Esconde todos os detalhes de produtos
    document.querySelectorAll(".produto-detalhe").forEach((d) => {
        d.style.display = "none";
    });

    const detalheSelecionado = document.querySelector(`#detalhe-produto-${id}`) || document.getElementById(id);
    if (detalheSelecionado) {
        detalheSelecionado.style.display = "block";
    } else {
        console.warn(`Elemento com ID '${id}' não encontrado.`);
    }
}

function voltarParaHome() {
    // Mostra o conteúdo principal
    document.getElementById("conteudo-principal").style.display = "block";


    document.querySelectorAll(".produto-detalhe").forEach((d) => {
        d.style.display = "none";
    });
}