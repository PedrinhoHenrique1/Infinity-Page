<?php
header('Content-Type: application/json');

// Simulação dos dados do pacote.
// O ideal é que esses dados venham do banco de dados, somando o peso e as dimensões dos produtos no carrinho.
$pesoTotal = 1; // em Kg
$alturaTotal = 5; // em cm
$larguraTotal = 15; // em cm
$comprimentoTotal = 20; // em cm

// CEP de origem (o CEP de onde sua loja envia os produtos)
$cepOrigem = "01001000"; // Ex: CEP da Praça da Sé, São Paulo

$data = json_decode(file_get_contents('php://input'), true);
$cepDestino = $data['cep'] ?? '';

if (empty($cepDestino)) {
    echo json_encode(['success' => false, 'message' => 'CEP de destino não informado.']);
    exit();
}

// Limpa o CEP para conter apenas números
$cepDestino = preg_replace("/[^0-9]/", "", $cepDestino);

// Monta a URL da API dos Correios (webservice antigo, porém funcional e sem necessidade de contrato)
// Serviços: 40010 = SEDEX, 41106 = PAC
$url = "http://ws.correios.com.br/calculador/CalcPrecoPrazo.aspx?"
    . "nCdEmpresa="
    . "&sDsSenha="
    . "&sCepOrigem={$cepOrigem}"
    . "&sCepDestino={$cepDestino}"
    . "&nVlPeso={$pesoTotal}"
    . "&nCdFormato=1" // 1 para caixa/pacote
    . "&nVlComprimento={$comprimentoTotal}"
    . "&nVlAltura={$alturaTotal}"
    . "&nVlLargura={$larguraTotal}"
    . "&sCdMaoPropria=n"
    . "&nVlValorDeclarado=0"
    . "&sCdAvisoRecebimento=n"
    . "&nCdServico=41106" // Código do serviço PAC. Mude para 40010 para SEDEX.
    . "&nVlDiametro=0"
    . "&StrRetorno=xml"
    . "&nIndicaCalculo=3";

// Inicia o cURL para fazer a requisição
$ch = curl_init($url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
$response = curl_exec($ch);
curl_close($ch);

if ($response === false) {
    echo json_encode(['success' => false, 'message' => 'Não foi possível conectar à API dos Correios.']);
    exit();
}

$xml = simplexml_load_string($response);

if (!$xml || !isset($xml->cServico)) {
    echo json_encode(['success' => false, 'message' => 'Resposta inválida da API dos Correios.']);
    exit();
}

$servico = $xml->cServico;

// Verifica se houve erro na resposta dos Correios
if ((string)$servico->Erro !== '0') {
    $mensagemErro = (string)$servico->MsgErro;
    echo json_encode(['success' => false, 'message' => 'Erro ao calcular o frete: ' . $mensagemErro]);
    exit();
}

// Prepara os dados de sucesso para retornar
$resultado = [
    'success' => true,
    'valor' => (string)$servico->Valor,
    'prazo' => (string)$servico->PrazoEntrega
];

echo json_encode($resultado);
?>