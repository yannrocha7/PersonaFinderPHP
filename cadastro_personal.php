<!DOCTYPE html>
<html>
<head>
    <title>Cadastro do Aluno</title>
    <link rel="stylesheet" href="style_personal_crud.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
</head>
<body>
    <div class="container">
        <h1>Cadastro do Personal</h1>
        <form method="post" action="conexão_personal_cadastro.php" enctype="multipart/form-data">
            <div class="form-group">
                <label for="cpf">CPF:</label>
                <input type="text" class="form-control" id="cpf" name="cpf" required>
            </div>
            <div class="form-group">
                <label for="nome">Nome:</label>
                <input type="text" class="form-control" id="nome" name="nome" required>
            </div>
            <div class="form-group">
                <label for="cep">Tipo de Treino:</label>
                <input type="text" class="form-control" id="tipoTreino" name="tipoTreino" required>
            </div>
              <div class="form-group">
                <label for="cep">Bairros que irá dar Aula:</label>
                <input type="text" class="form-control" id="bairrosTreino" name="bairrosTreino" required>
            </div>
            <div class="form-group">
                <label for="tipoPagamento">Tipo de Pagamento:</label>
                <select class="form-control" id="tipoPagamento" name="tipoPagamento" required>
                    <option value="credito">Crédito</option>
                    <option value="debito">Débito</option>
                </select>
            </div>

            <div class="form-group">
                <label for="tipoPagamento">Tipo de Pagamento do Aluno:</label>
                <select class="form-control" id="tipoPagamentoTreino" name="tipoPagamentoTreino" required>
                    <option value="credito">Crédito</option>
                    <option value="debito">Débito</option>
                    <option value="debito">PIX</option>
                </select>
            </div>

            <div class="form-group">
                <label for="email">Valor por treino:</label>
                <input type="number" class="form-control" id="valor" name="valor" required>
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
            <button type="submit" class="btn btn-primary">Cadastrar</button>
        </form>
    </div>
</body>
</html>
