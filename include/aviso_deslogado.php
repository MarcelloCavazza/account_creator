<?php
// mostra mensagem caso um usuario tente acessar
// uma pagina do site sem estar com sua sessao autenticada!
$logged = $_SESSION['logged'] ?? NULL;
if(!$logged) die('Você não está logado!<br>Volte a página inicial e logue<br><a href="index.php">Voltar</a>');
?>