<?php
session_start();

// Check if the email session variable is set
if (!isset($_SESSION['email'])) {
    header('Location: index_personal.php');
    exit();
}

if (isset($_GET['telefone'])) {
    // Número de telefone para o qual você deseja enviar a mensagem
    $telefone = $_GET['telefone'];
    // Faça o que precisar com o valor do cpfPersonal
}

$telefone = str_replace(['(', ')', '-', ' '], '', $telefone);
$telefone = '+55' . $telefone;
// Mensagem que você deseja enviar
$mensagem = 'Olá, gostaria de conversar sobre o treino';

// Crie o URL da API do WhatsApp
$url = 'https://api.whatsapp.com/send?phone=' . $telefone . '&text=' . urlencode($mensagem);

// Inicialize a biblioteca cURL
$curl = curl_init();

// Defina as opções da requisição cURL
curl_setopt_array($curl, [
    CURLOPT_URL => $url,
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_FOLLOWLOCATION => true,
    CURLOPT_SSL_VERIFYPEER => false, // Ajuste conforme necessário para certificados SSL
]);

// Executa a requisição cURL
$response = curl_exec($curl);

// Verifica se ocorreu algum erro na requisição
if ($response === false) {
    $error = curl_error($curl);
    // Trate o erro de acordo com suas necessidades
    echo 'Erro ao enviar a mensagem: ' . $error;
} else {
    // A mensagem foi enviada com sucesso
    header("Location: $url");
}

// Fecha a requisição cURL
curl_close($curl);
?>
