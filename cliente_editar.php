<?php
header("Content-type:text/html; charset=utf8");
require_once "include/status_login.php";
require_once "include/Functions.php";
$verificar_resultado = new Funcoes();
$status_logado_atual = $verificar_resultado->verificar($_SESSION['usuario'],$_SESSION['senha']);
if($_SESSION['logged'] == true){
    include_once "include/editar_conta.php";
}else{
    include_once "include/aviso_deslogado.php";
}

?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="utf-8">
    <title>Editar dados</title>
    <link rel="stylesheet" href="css/default.css">
    <link rel="stylesheet" href="css/editar_conta.css">
    <meta name="viewport" content="width=device-width, initial-scale=1">
</head>
<body>

</body>
</html
