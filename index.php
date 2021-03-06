<?php
    header("Content-type:text/html; charset=utf8");
    if(isset($_POST["email"]) && !empty($_POST["email"])
    && isset($_POST["senha"]) && !empty($_POST["senha"])){
        session_start();
        $user_email = $_POST['email'];
        $user_senha = $_POST['senha'];
        include_once "include/Functions.php";
        $verificar_resultado = new Funcoes();
        $_SESSION['usuario'] = $user_email;
        $_SESSION['senha'] = $user_senha;
        $status_logado_atual = $verificar_resultado->verificar($_SESSION['usuario'],$_SESSION['senha']);
        $id =  $verificar_resultado->getId($_SESSION['usuario'],$_SESSION['senha']);
        $_SESSION['id']=$id[0][0];
        if($_SESSION['logged'] == True){
            header("Location: dados_usuario.php");
        }else{
            echo "<script>alert(\"Dados de Login incorretos!\")</script>";
            echo "<script>document.getElementById('form').reset()</script>";
        }
    }
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/default.css">
    <link rel="stylesheet" href="css/index.css">
    <title>Cadastro de usuário</title>
</head>
<body>
    <button id="button-box">
        <a href="cadastrar.php">Clique aqui para criar uma conta!</a>    
    </button>
    <form method="post" action="index.php" id="form">
        <div><h1>Login</h1></div>
        <div class="input">
            <label for="email">Insira seu e-mail:</label><br>
            <input type="email" name="email" id="email" required>
        </div>
        <div class="input" id="">
            <label for="senha">Insira sua senha:</label><br>
            <input type="password" name="senha" id="senha" required>
        </div>
        <div id="buttons-form">
            <input type="submit" value="Entrar" class="btnforms">
            <input type="reset" value="Limpar campos" class="btnforms">
        </div>
    </form>
</body>
</html>