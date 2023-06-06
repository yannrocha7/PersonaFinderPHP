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

// Verificar se o link foi clicado
if (isset($_GET["cpfAluno"])) {
    $alunoCpf = $_GET["cpfAluno"];

    // Excluir a ficha de treino do aluno do banco de dados
    $sqlDelete = "DELETE FROM ficha_treino WHERE personal_cpf = '$cpf' AND aluno_cpf = '$alunoCpf'";
    if ($conn->query($sqlDelete) === TRUE) {
        header("Location: visualizar_aluno_unico.php?cpfAluno=" . $alunoCpf);
    } else {
        echo "Erro ao encerrar contrato: " . $conn->error;
    }
}

$conn->close();
?>
