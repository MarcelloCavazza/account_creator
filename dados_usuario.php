<?php
    include_once "include/status_login.php";
    include_once "include/Functions.php";
    header("Content-type:text/html; charset=utf8");
    $verificar_resultado = new Funcoes();
    $status_logado_atual = $verificar_resultado->verificar($_SESSION['usuario'],$_SESSION['senha']);
    if($_SESSION['logged'] == true){
        include_once "include/gerenciar_conta.php";
    }else{
        include_once "include/aviso_deslogado.php";
    }
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dados</title>
</head>
<body>

</body>
</html>