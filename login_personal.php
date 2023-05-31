<!DOCTYPE html>
<html>
<head>
  <title>Personal Finder - Login de Personal</title>
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
  <style>
    body {
      font-family: Arial, sans-serif;
      text-align: center;
    }
    .logo {
      margin-top: 50px;
    }
    h1 {
      margin-top: 20px;
    }
    .container {
      max-width: 400px;
      margin: 0 auto;
      padding: 20px;
    }
    .buttons {
      margin-top: 20px;
    }
    .buttons .btn {
      margin-bottom: 10px;
    }
    .buttons {
      margin-top: 20px;
    }

    .error-message {
      font-weight: bold;
      color: red;
    }
  </style>
</head>
<body>
  <div class="container">
    <div class="logo">
      <img src="logo.png" alt="Logo do Personal Finder">
      <h1>Personal Finder</h1>
    </div>

    <?php
    session_start();

    // Verificar se o usuário já está logado
    if (isset($_SESSION["email"])) {
      header("Location: index.php");
      exit();
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

      // Obter os valores do formulário
      $email = $_POST["email"];
      $senha = $_POST["senha"];

      // Consultar o banco de dados para verificar se o email e senha existem
      $sql = "SELECT * FROM login_personal WHERE email = '$email' AND senha = '$senha'";
      $result = $conn->query($sql);
      
      if ($result->num_rows > 0) {
        // Fetch the row from the query result
        $row = $result->fetch_assoc();
    
        // Retrieve the 'cpf' value from the row
        $cpf = $row['cpf'];
    
        $_SESSION['email'] = $email;
        $_SESSION['cpf'] = $cpf;
        $_SESSION['senha'] = $senha;
    
        header("Location: index_personal.php");
        exit();
      } else {
        echo "<p class='error-message'>Email ou senha incorretos. Por favor, tente novamente.</p>";
      }

      // Fechar a conexão com o banco de dados
      $conn->close();
    }
    ?>

    <h2>Login Para Personal</h2>
    <form method="POST" action="<?php echo $_SERVER["PHP_SELF"]; ?>">
      <div class="form-group">
        <label for="email">Email:</label>
        <input type="email" class="form-control" name="email" required>
      </div>
      <div class="form-group">
        <label for="senha">Senha:</label>
        <input type="password" class="form-control" name="senha" required>
      </div>
      <button type="submit" class="btn btn-primary btn-block">Entrar</button>
      <div class="row buttons">
        <div class="col">
          <a href="cadastro_personal.php" class="btn btn-success btn-block">Cadastre como Personal</a>
        </div>
      </div>
      <div class="row buttons">
        <div class="col">
          <a href="cadastro_aluno.php" class="btn btn-success btn-block">Cadastre como Aluno</a>
        </div>
      </div>
      <div class="row buttons">
        <div class="col">
          <a href="login_aluno.php" class="btn btn-secondary btn-block">É Aluno? Logue como Aluno</a>
        </div>
      </div>
    </form>
  </div>
</body>
</html>
