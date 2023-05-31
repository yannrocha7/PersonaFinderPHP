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
// Verificar se o formulário foi enviado
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Obter os dados do formulário
    $cpf = $_POST["cpf"];
    $nome = $_POST["nome"];
    $tipoTreino = $_POST["tipoTreino"];
    $bairrosTreino = $_POST["bairrosTreino"];
    $tipoPagamento = $_POST["tipoPagamento"];
    $valor = $_POST["valor"];
    $tipoPagamentoTreino = $_POST["tipoPagamentoTreino"];
    $senha = $_POST["senha"];
    $confirmasenha = $_POST["confirmarSenha"];
    $email = $_POST["email"];

    // Inserir os dados do aluno no banco de dados
    $sqlPersonal = "INSERT INTO personal (cpf, nome, tipo_treino, bairros_treino, tipo_pagamento, valor, forma_pagamento_aluno) VALUES ('$cpf', '$nome', '$tipoTreino', '$bairrosTreino', '$tipoPagamento', '$valor', '$tipoPagamentoTreino')";
    if ($conn->query($sqlPersonal) === TRUE) {
        // Obter o CPF gerado automaticamente
        $alunoCpf = $conn->insert_id;

        // Inserir os dados de login_aluno no banco de dados
        if ($senha == $confirmasenha) {
            $sqlLogin = "INSERT INTO login_personal (cpf, email, senha) VALUES ('$cpf', '$email', '$senha')";
            if ($conn->query($sqlLogin) === TRUE) {
                header("Location: login_personal.php");
            } else {
                echo "Erro ao cadastrar login_Personal: " . $conn->error;
            }
        } else {
            echo "Erro ao cadastrar: as senhas não coincidem.";
        }
    } else {
        echo "Erro ao cadastrar Personal: " . $conn->error;
    }
}

$conn->close();
?>
