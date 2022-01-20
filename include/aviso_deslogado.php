<?php
$logged = $_SESSION['logged'] ?? NULL;
if(!$logged) die('Você não está logado!<br>Volte a página inicial e logue<br><a href="index.php">Voltar</a>');
?>