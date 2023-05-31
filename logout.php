<?php
session_start();

// Destruir a sessão
session_destroy();

// Redirecionar para a página de login
header("Location: login_personal.php");
exit();
?>
