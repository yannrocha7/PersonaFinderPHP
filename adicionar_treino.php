<?php
session_start();

// Check if the email session variable is set
if (!isset($_SESSION['email'])) {
    header('Location: index_personal.php');
    exit();
}

 // Retrieve the email from the session
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
 

    // Inserir os dados do aluno no banco de dados
    $sqlFicha = "INSERT INTO ficha_treino (treino, personal_cpf, aluno_cpf) VALUES ('$treino', '$cpf', '$alunoCpf')";
    if ($conn->query($sqlFicha) === TRUE) {
        header("Location: visualizar_aluno_unico.php?cpfAluno=" . $alunoCpf);
        // Inserir os dados de login_aluno no banco de dados
    } else {
        echo "Erro ao cadastrar Personal: " . $conn->error;
    }
}

$conn->close();
?>
