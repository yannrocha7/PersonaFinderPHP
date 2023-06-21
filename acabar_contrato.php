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
    $sqlficha = "SELECT * FROM ficha_treino WHERE aluno_cpf = '$cpf'";
    $resultficha = $conn->query($sqlficha);
    $countFicha = mysqli_num_rows($resultficha);
   
    // Inserir os dados do aluno no banco de dados
    $sqlDeleteContrato = "DELETE FROM personal_aluno_contratacao WHERE aluno_cpf = '$cpf'";
    if ($countFicha > 0){
        $sqlDeleteficha = "DELETE FROM ficha_treino WHERE aluno_cpf = '$cpf'";
        $conn->query($sqlDeleteficha);
    }

    if ($conn->query($sqlDeleteContrato) === TRUE) {
        // Obter o CPF gerado automaticamente
        header('Location: index_aluno.php');
    } else {
        echo "Erro ao cadastrar Personal: " . $conn->error;
    }

$conn->close();
?>
