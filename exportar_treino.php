<?php
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['treino']) && isset($_POST['email'])) {
    $treino = $_POST['treino'];
    $email = $_POST['email'];
    $name = $_POST['name'];

    // Inclua o arquivo TCPDF
    require_once('tcpdf/tcpdf.php');

    // Crie uma nova instância do TCPDF
    $pdf = new TCPDF('P', 'mm', 'A4', true, 'UTF-8', false);

    // Defina o título do documento
    $pdf->SetTitle('Ficha de Treino');

    // Adicione uma página
    $pdf->AddPage();

    // Escreva o HTML no PDF
    $pdf->writeHTML($treino);

    // Defina o nome do arquivo de saída
    $arquivo = "ficha_" . $name . ".pdf";

    // Salve o PDF no arquivo
    $pdf->Output($arquivo, 'D');

    // Encerre o script
    exit();
}
?>
