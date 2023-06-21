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

    $sql = "SELECT * FROM login_personal WHERE cpf = '$cpf'";
    $result = $conn->query($sql);
    if ($result !== false && $result->num_rows > 0) {
        $update = "UPDATE login_personal SET senha='$senha' WHERE cpf = '$cpf'";

        if ($conn->query($update) === TRUE) {
            sleep(3);
            header("Location: login_personal.php");

        } else {
            echo "Erro ao atualizar os dados: " . $conn->error;
        }
    } else {
        echo "<p>Email ou CPF não existe.</p>";
    }

$conn->close();
?>
