<?php
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['treino']) && isset($_POST['email'])) {
    $treino = $_POST['treino'];
    $email = $_POST['email'];
    $name = $_POST['name'];

    // Defina o nome do arquivo de saída
    $arquivo = "ficha_" . $name . ".txt";

    // Crie ou abra o arquivo em modo de escrita
    $handle = fopen($arquivo, "w");

    // Escreva o treino no arquivo
    fwrite($handle, $treino);

    // Feche o arquivo
    fclose($handle);

    // Defina o cabeçalho HTTP para forçar o download como arquivo de texto
    header('Content-Type: text/plain');
    header('Content-Disposition: attachment; filename="' . $arquivo . '"');

    // Envie o arquivo para o navegador
    readfile($arquivo);

    // Apague o arquivo depois que ele for enviado
    unlink($arquivo);
}
?>
