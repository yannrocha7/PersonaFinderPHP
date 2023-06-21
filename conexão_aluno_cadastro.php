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
    $cep = $_POST["cep"];
    $senha = $_POST["senha"];
    $confirmasenha = $_POST["confirmarSenha"];
    $email = $_POST["email"];
    $telefone = $_POST["telefone"];

    // Inserir os dados do aluno no banco de dados
    $sqlAluno = "INSERT INTO aluno (cpf, nome, CEP, telefone) VALUES ('$cpf', '$nome', '$cep', '$telefone')";
    if ($conn->query($sqlAluno) === TRUE) {
        // Obter o CPF gerado automaticamente
        $alunoCpf = $conn->insert_id;

        // Inserir os dados de login_aluno no banco de dados
        if ($senha == $confirmasenha) {
            $sqlLogin = "INSERT INTO login_aluno (cpf, email, senha) VALUES ('$cpf', '$email', '$senha')";
            if ($conn->query($sqlLogin) === TRUE) {
                // Redirecionar com mensagem de sucesso
                header("Location: login_aluno.php?success=1");
            } else {
                // Redirecionar com mensagem de erro
                header("Location: login_aluno.php?error=1&message=" . urlencode("Erro ao cadastrar: " . $conn->error));
            }
        } else {
            echo "Erro ao cadastrar: as senhas não coincidem.";
        }
    } else {
        echo "Erro ao cadastrar aluno: " . $conn->error;
    }
}

$conn->close();
?>
