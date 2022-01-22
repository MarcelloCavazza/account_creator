<?php
    header("Content-type:text/html; charset=utf8");
    if(isset($_POST["nome_cliente"]) && !empty($_POST["nome_cliente"])
    && isset($_POST["email_cliente"]) && !empty($_POST["email_cliente"])
    && isset($_POST["telefone_cliente"]) && !empty($_POST["telefone_cliente"])
    && isset($_POST["senha_cliente"]) && !empty($_POST["senha_cliente"])
    && isset($_POST["data_nasc_cliente"]) && !empty($_POST["data_nasc_cliente"])){
        //trazendo já o valor do formulário
        $nome_cliente = $_POST["nome_cliente"];
        $email_cliente = $_POST["email_cliente"];    
        $telefone_cliente = $_POST["telefone_cliente"];
        $senha_cliente = $_POST["senha_cliente"];
        $data_nasc_cliente = $_POST["data_nasc_cliente"];

        //criando variaveis para testara cada input do formulario de cadastro
        $name_error = '';
        $senha_error = '';
        $tel_error = '';
        $date_error = '';
        $email_error = '';
        //testando algum input está fora dos confomes.
                    //usando regex como filtro
        if(!preg_match("/^[a-zA-Z\s]*$/",$nome_cliente)){
            $name_error= 'Nome Invalido(Somente palavras e espaços em branco são aceitos)';
        }
        if(!filter_var($email_cliente, FILTER_VALIDATE_EMAIL)){
            $email_error= 'Email inválido';
        }               //usando regex como filtro
        if(!preg_match("/^(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9])[\w$@]{3,}$/", $senha_cliente)){
            $senha_error = 'Senha inválida! Minimo 3 char.. Obrigatório conter um de cada: a-z,A-Z e qualquer numero. Podem ser colocados: "_","@","$", Ex: 3xA';
        }
        $data_array = explode("-",$data_nasc_cliente);
        if(count($data_array) == 3){
            if(!checkdate($data_array[1],$data_array[2],$data_array[0])){
                $date_error='Data inválida';
            }
        }else{ //esse erro aqui seria algum erro mais diretamente no input do forms pq ai a data
                // n teria vindo de uma forma correta para se fazer a condicional em cima 
            $date_error='Erro no cadastro da data! Tente novamente sua data de nascimento - Data inválida';
        }
        if(strlen($telefone_cliente)<=13){
            $tel_error = 'Telefone inválido';
        }

        //verifica se n ha nenhum erro
        if($name_error == '' && $senha_error == '' && $tel_error == '' && $date_error == '' && $email_error == ''){
            include_once "include/Functions.php";
            $funcao = new Funcoes();
            if($funcao->cadastrar($nome_cliente,$email_cliente,$telefone_cliente,$senha_cliente,$data_nasc_cliente)){
                session_start();
                $_SESSION['usuario'] = $email_cliente;
                $_SESSION['senha'] = $senha_cliente;
                $_SESSION['logged'] = True;
                $id =  $funcao->getId($_SESSION['usuario'],$_SESSION['senha']);
                $_SESSION['id']=$id[0][0];
                $vef_result = $funcao->verificarSeJaExiste($email_cliente,$telefone_cliente);
                switch($vef_result){
                    case 2:
                        echo "<script>alert('Email já utilizado!')</script>";
                        break;
                    case 4:
                        echo "<script>alert('Telefone já utilizado!')</script>";
                        break;
                    case 6: // 2 = email usado e 4 = telefone já usado ou seja 4+2 = Tel e Email já usados
                        echo "<script>alert('Email e Telefone já utilizado!')</script>";
                        break;
                    default:
                        $vef_result_final = 0;
                        break;
                }
                if($vef_result_final == 0){
                    echo "<script>alert(\"Conta criada com sucesso!\")</script>";
                    header("Location: dados_usuario.php");
                }elseif($funcao->deletarConta($_SESSION['id'])){
                    echo "<script>alert(\"Erro no cadastro!\")</script>";
                }
            }          
        }else{
            //junta todas as variaveis q podem ter uma msg dizendo algum erro, assim o servidor avisa o usuário!
                if($tel_error!= ''){
                    echo "<script>alert('{$tel_error}')</script>";
                }
                if($date_error != ''){
                    echo "<script>alert('{$date_error}')</script>";
                }if($name_error != ''){
                    echo "<script>alert('{$name_error}')</script>";
                }
                if($email_error != ''){
                    echo "<script>alert('{$email_error}')</script>";
                }
                if ($senha_error != '') {
                    echo "<script>alert('{$senha_error}')</script>";
                }
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
    <script src="js/mascaras.js"></script>
    <link rel="stylesheet" href="css/default.css">
    <link rel="stylesheet" href="css/cadastrar.css">
    <title>Cadastro</title>
</head>
<body>
    <div id="title"><h1>Insira seus dados para criar a conta</h1></div>
    <form method="POST" action="cadastrar.php" id="form">
        <div  class="buttons-form">
            <label for="nome">Insira seu nome completo:</label><br>
            <input type="text" name="nome_cliente" id="nome" placeholder="seu nome" required>
        </div>
        <div  class="buttons-form">
            <label for="email">Insira e-mail:</label><br>
            <input type="email" name="email_cliente" id="email" placeholder="seu email" required>
        </div>
        <div  class="buttons-form">
            <label for="telefone">Insira seu telefone:</label><br>
            <input type="tel" name="telefone_cliente" id="telefone" placeholder="(31)99999-9999" oninput=mascara_telefone() maxlength="14" required>
        </div>
        <div  class="buttons-form">
            <label for="senha">Insira sua senha:</label><br>
            <input type="password" name="senha_cliente" id="senha" placeholder="Insira sua senha" minlength="3" maxlength="255" required>
        </div>
        <div  class="buttons-form">
            <label for="data">Insira sua data de nascimento:</label><br>
            <input type="date" name="data_nasc_cliente" id="data" min="1900-01-01" placeholder="Insira sua data de nascimento" required>
        </div>
        <div  class="buttons-form">
            <input type="submit" value="Criar conta">
            <input type="reset" value="Limpar campos">
        </div>
    </form>
    <button id="button-box"><a href="?logout=1">Voltar</a></button>
</body>
</html>