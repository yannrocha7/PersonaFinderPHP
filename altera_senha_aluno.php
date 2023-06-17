<!DOCTYPE html>
<html>
<head>
    <title>Esqueci minha senha</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
    <link rel="icon" type="image/x-icon" href="assets/favicon.ico" />
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: rgba(26, 188, 156, 1) !important;
        }

        h2 {
            color: #333;
            text-align: center;
        }

        form {
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            text-align: center;
            max-width: 400px;
            margin: 0 auto;
            background-color: #fff;
            padding: 20px;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        label {
            display: block;
            margin-bottom: 10px;
            color: #333;
            font-weight: bold;
        }

        input[type="text"],
        input[type="email"] {
            width: 94%;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 3px;
        }

        input[type="submit"] {
            display: block;
            width: 100%;
            padding: 10px;
            background-color: #4CAF50;
            color: #fff;
            border: none;
            border-radius: 3px;
            cursor: pointer;
        }

        input[type="submit"]:hover {
            background-color: #45a049;
        }

        input[type="submit"]:focus {
            outline: none;
        }

        .error {
            color: #ff0000;
            margin-top: 5px;
        }
        button {
            margin-top: 5px;
        }
    </style>
    <script>
        function mascaraCPF(campo) {
            campo.value = campo.value.replace(/\D/g, '').replace(/(\d{3})(\d)/, '$1.$2').replace(/(\d{3})(\d)/, '$1.$2').replace(/(\d{3})(\d{1,2})$/, '$1-$2');
        }

        function validarEmail(email) {
            var re = /\S+@\S+\.\S+/;
            return re.test(email);
        }
    </script>
</head>
<body>
<?php
    // Verifica se os campos CPF e E-mail estão definidos e não estão vazios
    if (isset($_POST['senha']) && !empty($_POST['senha'])) {
        $senha = $_POST['senha'];
    }

    // Verificar se o formulário foi enviado

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Conectar ao banco de dados
    $servername = "localhost";
    $username = "root";
    $password = "";
    $database = "PersonaFinder";

    $conn = new mysqli($servername, $username, $password, $database);

    // Verificar se a conexão foi estabelecida com sucesso
    if ($conn->connect_error) {
        die("Erro na conexão com o banco de dados: " . $conn->connect_error);
    }

    // Consultar o banco de dados para verificar se o email e senha existem
    $sql = "SELECT * FROM aluno WHERE cpf = '$cpf' AND email = '$email'";
    $result = $conn->query($sql);
        if ($result !== false && $result->num_rows > 0) {
            // Fetch the row from the query result
            $row = $result->fetch_assoc();

            echo $cpf;
            echo $email;

            // Retrieve the 'cpf' value from the row
            $cpf = $row['cpf'];
            $email = $row['email'];

            $_SESSION['email'] = $email;
            $_SESSION['cpf'] = $cpf;

//            header("Location: altera_senha_aluno.php");
            exit();
        } else {
            echo "<p  >Email ou senha não existe.</p>";
        }

        // Fechar a conexão com o banco de dados
        $conn->close();
    }

?>
<h2>Alterar senha</h2>
<form method="post">
    <label for="senha">Nova senha:</label>
    <input type="password" id="senha" name="senha" required><br><br>
    <input type="submit" value="Alterar">
    <button type="button" onclick="window.location.href='esqueci_senha.php.php';" class="btn btn-primary btn-block">Voltar</button>
</form>
</body>
</html>