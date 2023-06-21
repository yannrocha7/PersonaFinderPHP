<!DOCTYPE html>
<html>
<head>
  <title>Personal Finder</title>
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
  <link rel="icon" type="image/x-icon" href="assets/favicon.ico" />
  <style>
   body {
      font-weight: bold;
      font-family: Arial, sans-serif;
      text-align: center;
      background-color: rgba(26, 188, 156, 1) !important;
      color: #333;
      height: 100%;
      margin: 0;
      display: flex;
      align-items: center;
      justify-content: center;
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

   form {
       color: black;
       max-width: 400px;
       margin: 0 auto;
       background-color: #fff;
       padding: 20px;
       border-radius: 5px;
       box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
   }

    .title{
      font-size: 40px;
      text-transform: uppercase;
      color: black;
      font-family: "Montserrat", -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, "Helvetica Neue", Arial, "Noto Sans", sans-serif, "Apple Color Emoji", "Segoe UI Emoji", "Segoe UI Symbol", "Noto Color Emoji";
      font-weight: 700;
    }

    .form-group {
      text-align-last: left;
    }
    .cadastro-button {
      justify-content: space-evenly;
    }
  </style>
    <div class="container">
      <h1 class="title">Personal Finder</h1>
</head>
<body>

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
      $sql = "SELECT * FROM login_aluno WHERE email = '$email' AND senha = '$senha'";
      $result = $conn->query($sql);
      
      if ($result->num_rows > 0) {
        // Fetch the row from the query result
        $row = $result->fetch_assoc();
    
        // Retrieve the 'cpf' value from the row
        $cpf = $row['cpf'];
    
        $_SESSION['email'] = $email;
        $_SESSION['cpf'] = $cpf;
        $_SESSION['senha'] = $senha;
    
        header("Location: index_aluno.php");
        exit();
      } else {
        echo "<p class='error-message'>Email ou senha incorretos. Por favor, tente novamente.</p>";
      }

      // Fechar a conexão com o banco de dados
      $conn->close();
    }
    ?>

    <h2>Login Para Aluno</h2>
    <?php 
     // Verificar se há uma mensagem de sucesso
      if (isset($_GET['success']) && $_GET['success'] == 1) {
        echo '<h4 class="flash-message success">Cadastro realizado com sucesso!</h4>';
      }

      // Verificar se há uma mensagem de erro
      if (isset($_GET['error']) && $_GET['error'] == 1) {
        $errorMessage = isset($_GET['message']) ? urldecode($_GET['message']) : 'Erro desconhecido';
        echo '<div class="flash-message error">' . $errorMessage . '</div>';
      }
    ?>
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
      <div class="row cadastro-button">
        <div class="buttons">
          <a href="cadastro_personal.php" class="btn btn-success btn-block">Cadastro personal</a>
        </div>
        <div class="buttons">
          <a href="cadastro_aluno.php" class="btn btn-success btn-block">Cadastro aluno</a>
        </div>
      </div>
      <div class="row buttons">
        <div class="col">
          <a href="login_personal.php" class="btn btn-secondary btn-block">É Personal? Logue como Personal</a>
        </div>
      </div>
      <div class="row buttons">
        <div class="col">
            <a href="esqueci_senha.php" class="btn btn-success btn-block">Recuperar senha</a>
        </div>
      </div>
    </form>
  </div>
</body>
</html>
