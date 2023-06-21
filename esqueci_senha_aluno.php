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
    if (isset($_POST['cpf']) && isset($_POST['email']) && !empty($_POST['cpf']) && !empty($_POST['email'])) {
        $cpf = $_POST['cpf'];
        $email = $_POST['email'];
    }



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
        $sql = "SELECT * FROM login_aluno WHERE cpf = '$cpf' AND email = '$email'";
        $result = $conn->query($sql);
            if ($result !== false && $result->num_rows > 0) {
                $_SESSION['cpf'] = $cpf;
                header("Location: altera_senha_aluno_html.php");
                exit();
            } else {
                echo "<p>Email ou CPF não existe.</p>";
            }

            // Fechar a conexão com o banco de dados
            $conn->close();
    }

?>
<h2>Esqueci minha senha</h2>
<form method="post">
    <label for="cpf">CPF:</label>
    <input type="text" id="cpf" name="cpf" oninput="mascaraCPF(this)" maxlength="14" required><br><br>
    <label for="email">E-mail:</label>
    <input type="email" id="email" name="email" onblur="validarEmail(this.value)" required><br><br>
    <input type="submit" value="Recuperar Senha">
    <button type="button" onclick="window.location.href='login_aluno.php';" class="btn btn-primary btn-block">Voltar</button>
</form>
</body>
</html>