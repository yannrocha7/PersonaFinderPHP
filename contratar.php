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
    if (isset($_GET['cpfPersonal'])) {
        $cpfPersonal = $_GET['cpfPersonal'];
        // Faça o que precisar com o valor do cpfPersonal
    }

    $sqlpersonal = "SELECT * FROM personal  WHERE cpf = '$cpfPersonal'";
    $resultpersonal = $conn->query($sqlpersonal);
    if ($resultpersonal && $resultpersonal->num_rows > 0) {
        $row = $resultpersonal->fetch_assoc();
        $cpfPersonal = $row["cpf"];
        $valorTreino = $row["valor"];
        $tipo_pagamentoPersonalAluno = $row["forma_pagamento_aluno"];
    }
    // Inserir os dados do aluno no banco de dados
    $sqlPersonal = "INSERT INTO personal_aluno_contratacao (aluno_cpf, personal_cpf, metodo_pagamento, valor) VALUES ('$cpf', '$cpfPersonal', '$tipo_pagamentoPersonalAluno', '$valorTreino')";
    if ($conn->query($sqlPersonal) === TRUE) {
        // Obter o CPF gerado automaticamente
        header('Location: index_aluno.php');
    } else {
        echo "Erro ao cadastrar Personal: " . $conn->error;
    }

$conn->close();
?>
