<?php
    if(isset($_POST["nome_cliente"]) && !empty($_POST["nome_cliente"])
    && isset($_POST["email_cliente"]) && !empty($_POST["email_cliente"])
    && isset($_POST["telefone_cliente"]) && !empty($_POST["telefone_cliente"])
    && isset($_POST["senha_cliente"]) && !empty($_POST["senha_cliente"])
    && isset($_POST["data_nasc_cliente"]) && !empty($_POST["data_nasc_cliente"])){
        include_once "include/Functions.php";
        $nome_cliente = $_POST["nome_cliente"];
        $email_cliente = $_POST["email_cliente"];    
        $telefone_cliente = $_POST["telefone_cliente"];
        $senha_cliente = $_POST["senha_cliente"];
        $data_nasc_cliente = $_POST["data_nasc_cliente"];
        $funcao = new Funcoes();
        if($funcao->cadastrar($nome_cliente,$email_cliente,$telefone_cliente,$senha_cliente,$data_nasc_cliente)){
            session_start();
            $_SESSION['usuario'] = $email_cliente;
            $_SESSION['senha'] = $senha_cliente;
            $_SESSION['logged'] = True;
            $id =  $funcao->getId($_SESSION['usuario'],$_SESSION['senha']);
            $_SESSION['id']=$id[0][0];
            echo "<script>alert(\"Conta cadastrada com sucesso!\")</script>";
            header("Location: dados_usuario.php");
        }else{
            echo "<script>alert(\"Erro no cadastro!\")</script>";
            echo "<script>document.getElementById('form').reset()</script>";
        }
    }
    if(isset($_GET['logout']) && $_GET['logout']==1){
        $_SESSION = array();
        session_destroy();
        header('Location: index.php');
    }
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="js/function.js"></script>
    <title>Cadastro</title>
</head>
<body>
    <div>Insira seus dados para criar a conta</div>
    <form method="POST" action="cadastrar.php" id="form">
        <label for="nome">Insira seu nome completo:</label>
        <input type="text" name="nome_cliente" id="nome" placeholder="seu nome" required>
        <label for="email">Insira e-mail:</label>
        <input type="email" name="email_cliente" id="email" placeholder="seu email" required>
        <label for="telefone">Insira seu telefone:</label>
        <input type="tel" name="telefone_cliente" id="telefone" placeholder="(31)99999-9999" oninput=mascara_telefone() maxlegth="14" required>
        <label for="senha">Insira sua senha:</label>
        <input type="password" name="senha_cliente" id="senha" placeholder="Insira sua senha" required>
        <label for="data">Insira sua data de nascimento:</label>
        <input type="date" name="data_nasc_cliente" id="data" min="1900-01-01" placeholder="Insira sua data de nascimento" required>
        <input type="submit" value="Criar conta">
        <input type="reset" value="Limpar campos">
    </form>
    <button><a href="?logout=1">Voltar</a></button>
</body>
</html>