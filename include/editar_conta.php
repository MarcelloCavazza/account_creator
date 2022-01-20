<?php

//tanto o cod quanto a pagina só é carregado,caso o usuario entre
//com a sessao autenticada no arquivo cliente_editar.php 
$cliente_dados = new Funcoes;
//pega qual o ID do usuario para fazer puxar os dados do usuario especifico
if(isset($_GET["id_cliente"])){
    $array_dados_cliente = $cliente_dados->listar($_GET["id_cliente"]);
}
//verifica se todos os arquivos estao definidos e preenchidos para realizar o comando
//de atualizar os dados no banco de dados e se der tudo certo ele volta a página dados_usario.php
if(isset($_POST["nome_cliente"]) && !empty($_POST["nome_cliente"])
    && isset($_POST["email_cliente"]) && !empty($_POST["email_cliente"])
    && isset($_POST["telefone_cliente"]) && !empty($_POST["telefone_cliente"])
    && isset($_POST["senha_cliente"]) && !empty($_POST["senha_cliente"])
    && isset($_POST["data_nasc_cliente"]) && !empty($_POST["data_nasc_cliente"]))
{
    $result = $cliente_dados->atualizar();       
    if($result == '1'){
        header('location: dados_usuario.php');
    }else{
        echo "<script>alert('Erro ao atualizar dados! Tente novamente ou contate o suporte.')</script>";
    }
}
?>
<!-- usando um foreach é printado os dados do cliente da sessao atual -->
<div>
    <div>
        <div>
            <h3>Editar Aluno</h3>
        </div>
    </div=>
     <div class="row">
       <div class="col-lg-12">
       <form action="cliente_editar.php" method="post" id="form">
            <?php
                foreach($array_dados_cliente as $cliente_dados){
                    echo "
                    <div>
                        <label for='nome_cliente'>Nome</label>
                        <input type='text' name='nome_cliente' id='nome_cliente'value='{$cliente_dados[1]}'required>
                    </div>
                    <div >
                        <label for='email_cliente'>E-mail</label>
                        <input type='email' name='email_cliente' id='email_cliente'value='{$cliente_dados[2]}' required>
                    </div>
                    <div>
                        <label for='senha_cliente'>Senha</label>
                        <input type='text' name='senha_cliente' id='senha_cliente'value='{$cliente_dados[4]}' required>
                    </div>
                    <div>
                        <label for='data_nasc_cliente'>Data de Nasc</label>
                        <input type='text' name='data_nasc_cliente' id='data_nasc_cliente' value='{$cliente_dados[5]}' required>
                    </div>
                    <div>
                        <label for='telefone_cliente'>Telefone</label>
                        <input type='text' name='telefone_cliente' id='telefone_cliente'value='{$cliente_dados[3]}' required>
                    </div>
                    ";
                }
            ?>
            <div>
                <button type="submit" name="salvar" value="salvar">Salvar</button>
                <button><a href="dados_usuario.php">Voltar</a></button>
            </div>
            </div>
        </form>
       </div>
    </div>
</div>