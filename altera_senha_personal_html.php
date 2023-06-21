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

        input[type="password"],
        input[type="text"] {
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
    </script>
</head>
<body>
<h2>Alterar senha</h2>
<form method="post" action="altera_senha_personal.php">
    <label for="senha">Confirme seu CPF:</label>
    <input type="text" id="cpf" name="cpf" oninput="mascaraCPF(this)" maxlength="14" required><br><br>
    <label for="senha">Nova senha:</label>
    <input type="password" id="senha" name="senha" required><br><br>
    <input type="submit" value="Alterar">
    <button type="button" onclick="window.location.href='esqueci_senha_personal.php';" class="btn btn-primary btn-block">Voltar</button>
</form>
</body>
</html>