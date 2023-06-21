<!DOCTYPE html>
<html>
<head>
    <title>Cadastro do Aluno</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
    <link rel="icon" type="image/x-icon" href="assets/favicon.ico" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.inputmask/5.0.6/jquery.inputmask.min.js"></script>
    <script>
                $(document).ready(function() {
                    $('#telefone').inputmask('(99) [9]9999-9999', { "placeholder": " " });
                });

                $(document).ready(function() {
                    $('#cep').inputmask('99999-999', { "placeholder": " " });
                });
                $(document).ready(function() {
                     $('#cpf').inputmask('999.999.999-99', { "placeholder": " " });
                });
    </script>
    <style>
        body {
            font-family: Arial, sans-serif;
            text-align: center;
            background-color: rgba(26, 188, 156, 1) !important;
            color: rgba(255, 255, 255);
            height: 100%;
            margin: 0;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        .container {
            margin-top: 50px;
            border: 1px solid #ccc;
            padding: 20px;
            border-radius: 5px;
            background-color: #fff;
            color: #1a1e21;
            text-align: -webkit-left;
        }
        h1 {
            text-align: center;
            margin-bottom: 30px;
        }
        form {
            background-color: #fff;
            padding: 20px;
            border-radius: 5px;
        }
        .form-group {
            margin-bottom: 20px;
        }
        label {
            font-weight: bold;
        }

    </style>
</head>
<body>
    <div class="container">
        <h1>Cadastro do Aluno</h1>
        <form method="post" action="conexão_aluno_cadastro.php" enctype="multipart/form-data">
            <div class="form-group">
                <label for="cpf">CPF:</label>
                <input type="text" class="form-control" id="cpf" name="cpf" required>
            </div>
            <div class="form-group">
                <label for="nome">Nome:</label>
                <input type="text" class="form-control" id="nome" name="nome" required>
            </div>
            <div class="form-group">
                <label for="cep">CEP:</label>
                <input type="text" class="form-control" id="cep" name="cep" required>
            </div>
            <div class="form-group">
                <label for="telefone">Telefone:</label>
                <input type="tel" class="form-control" id="telefone" name="telefone" required>
            </div>

            <div class="form-group">
                <label for="email">E-mail:</label>
                <input type="email" class="form-control" id="email" name="email" required>
            </div>
            <div class="form-group">
                <label for="senha">Senha:</label>
                <input type="password" class="form-control" id="senha" name="senha" required>
            </div>
            <div class="form-group">
                <label for="confirmarSenha">Confirmar Senha:</label>
                <input type="password" class="form-control" id="confirmarSenha" name="confirmarSenha" required>
            </div>
            <button type="submit" class="btn btn-success">Cadastrar</button>
            <button type="button" onclick="window.location.href='login_aluno.php';" class="btn btn-primary">Voltar</button>
        </form>
    </div>
</body>
</html>
