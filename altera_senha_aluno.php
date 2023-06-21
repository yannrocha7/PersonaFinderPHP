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
$senha = $_POST['senha'];
$cpf = $_POST['cpf'];

// Query para atualizar os dados na tabela "personal"
$query = "UPDATE login_aluno SET senha='$senha' WHERE cpf = '$cpf'";

if ($conn->query($query) === TRUE) {
    sleep(3);
    header("Location: login_aluno.php");

} else {
    echo "Erro ao atualizar os dados: " . $conn->error;
}

// Fecha a conexão com o banco de dados
$conn->close();
?>
