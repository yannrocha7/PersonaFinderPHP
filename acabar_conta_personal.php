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
        header('Location: index_personal.php');
        exit();
    }

    // Retrieve the email from the session
    $email = $_SESSION["email"];
    $cpf = $_SESSION["cpf"];
    $sqlficha = "SELECT * FROM ficha_treino WHERE personal_cpf = '$cpf'";
    $resultficha = $conn->query($sqlficha);
    $countFicha = mysqli_num_rows($resultficha);
    $sqlcontrato = "SELECT * FROM personal_aluno_contratacao WHERE personal_cpf = '$cpf'";
    $resultcontrato = $conn->query($sqlcontrato);
    $countcontrato = mysqli_num_rows($resultcontrato);
   
    // Inserir os dados do aluno no banco de dados
    if ($countFicha > 0){
        $sqlDeleteficha = "DELETE FROM ficha_treino WHERE personal_cpf = '$cpf'";
        $conn->query($sqlDeleteficha);
    }

    if ($countcontrato > 0){
        $sqlDeleteContrato = "DELETE FROM personal_aluno_contratacao WHERE personal_cpf = '$cpf'";
        $conn->query($sqlDeleteContrato);
    }

    $sqlDeletePersonal = "DELETE FROM personal WHERE cpf = '$cpf'";
    if ($conn->query($sqlDeletePersonal) === TRUE) {
        session_destroy();
        // Obter o CPF gerado automaticamente
        header('Location: login_personal.php');
    } else {
        echo "Erro: " . $conn->error;
    }

$conn->close();
?>
