<?php
session_start();
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
$cep = $_POST['cep'];
$telefone = $_POST['telefone'];
$cpf = $_SESSION["cpf"];

// Query para atualizar os dados na tabela "personal"
$query = "UPDATE aluno SET nome='$nome', cep='$cep', telefone='$telefone' WHERE cpf='$cpf'";

if ($conn->query($query) === TRUE) {
    header("Location: index_aluno.php");

} else {
    echo "Erro ao atualizar os dados: " . $conn->error;
}

// Fecha a conexão com o banco de dados
$conn->close();
?>
