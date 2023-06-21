<?php
session_start();
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
$cpf = $_SESSION["cpf"];
$nota = $_POST['nota'];
$cpfPersonal = $_POST['cpfpersonal'];

$sqlp = "SELECT * FROM personal WHERE cpf = '$cpfPersonal'";
$resultp = $conn->query($sqlp);
    
if ($resultp && $resultp->num_rows > 0) {
    $row = $resultp->fetch_assoc();
    $media_nota = $row['media_nota'];
    $quant_nota = $row['quant_nota'];
}

if($media_nota == -1){
    $media_nota = 0;
}

$nova_quant_nova = $quant_nota + 1;
$nova_media = ($nota + $media_nota) / $nova_quant_nova;
$snova_media = round($nova_media);
// Query para atualizar os dados na tabela "personal"
$query = "UPDATE personal_aluno_contratacao 
          SET nota = '$nota' 
          WHERE personal_cpf = '$cpfPersonal' AND aluno_cpf = '$cpf'";

$queryp = "UPDATE personal SET quant_nota='$nova_quant_nova', media_nota='$snova_media' WHERE cpf='$cpfPersonal'";

if ($conn->query($query) === TRUE && $conn->query($queryp) === TRUE) {
    header("Location: index_aluno.php");

} else {
    echo "Erro ao atualizar os dados: " . $conn->error;
}

// Fecha a conexão com o banco de dados
$conn->close();
?>
