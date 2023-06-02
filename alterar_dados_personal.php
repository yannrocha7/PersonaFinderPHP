<?php
// Conexão com o banco de dados
$servername = "localhost";
$username = "root";
$password = "";
$database = "PersonaFinder";

$conn = new mysqli($servername, $username, $password, $database);

// Verifica a conexão
if ($conn->connect_error) {
    die("Falha na conexão: " . $conn->connect_error);
}

// Obtém os valores alterados do formulário
$nome = $_POST['nome'];
$tipo_treino = $_POST['tipo_treino'];
$bairros_treino = $_POST['bairros_treino'];
$tipo_pagamento = $_POST['tipo_pagamento'];
$valor = $_POST['valor'];

// Query para atualizar os dados na tabela "personal"
$query = "UPDATE personal SET nome='$nome', tipo_treino='$tipo_treino', bairros_treino='$bairros_treino', tipo_pagamento='$tipo_pagamento', valor='$valor'";

if ($conn->query($query) === TRUE) {
    header("Location: atualiza_personal.php");

} else {
    echo "Erro ao atualizar os dados: " . $conn->error;
}

// Fecha a conexão com o banco de dados
$conn->close();
?>
