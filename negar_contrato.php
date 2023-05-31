<?php

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

    session_start();

    // Check if the email session variable is set
    if (!isset($_SESSION['email'])) {
        header('Location: index_aluno.php');
        exit();
    }

    // Retrieve the email from the session
    $email = $_SESSION["email"];
    $cpf = $_SESSION["cpf"];
    if (isset($_GET['cpfAluno'])) {
        $cpfAluno = $_GET['cpfAluno'];
        // Faça o que precisar com o valor do cpfPersonal
    }

    // Inserir os dados do aluno no banco de dados
    $sqlDeleteContrato = "DELETE FROM personal_aluno_contratacao WHERE personal_cpf = '$cpf' AND aluno_cpf = '$cpfAluno'";
    if ($conn->query($sqlDeleteContrato) === TRUE) {
        // Obter o CPF gerado automaticamente
        header('Location: index_personal.php');
    } else {
        echo "Erro ao cadastrar Personal: " . $conn->error;
    }

$conn->close();
?>
