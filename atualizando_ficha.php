<?php
session_start();

// Verificar se a variável de sessão "email" está definida
if (!isset($_SESSION['email'])) {
    header('Location: index_personal.php');
    exit();
}

// Recuperar o email da sessão
$email = $_SESSION["email"];
$cpf = $_SESSION["cpf"];

// Dados de conexão
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "PersonaFinder";

// Criar conexão
$conn = new mysqli($servername, $username, $password, $dbname);

// Verificar conexão
if ($conn->connect_error) {
    die("Falha na conexão: " . $conn->connect_error);
}

// Verificar se o formulário foi enviado
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Obter os dados do formulário
    $treino = $_POST["treino"];
    $alunoCpf = $_POST["cpfAluno"];

    // Atualizar o treino no banco de dados
    $sqlUpdate = "UPDATE ficha_treino SET treino = '$treino' WHERE personal_cpf = '$cpf' AND aluno_cpf = '$alunoCpf'";
    if ($conn->query($sqlUpdate) === TRUE) {
        header("Location: visualizar_aluno_unico.php?cpfAluno=" . $alunoCpf);
    } else {
        echo "Erro ao atualizar o treino: " . $conn->error;
    }
}

$conn->close();
?>
