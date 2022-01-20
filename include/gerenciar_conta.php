<?php
//codigo que aparece se a sessao do usuario estiver atenticada para ele visualizar seus dados
// e clicar em editar caso desejar
$funcao_listar = new Funcoes();
$array_dados_cliente = $funcao_listar->listar($_SESSION['id']);
//caso o usuario clicar no botao "Deslogar", ele desloga e esse codigo destroi sua sessao
// e volta a pagina inicial
if(isset($_GET['logout']) && $_GET['logout']==1){
    $_SESSION = array();
    session_destroy();
    header('Location: index.php');
}
?>
    <table id="customers">
        <tr>
            <th>Nome Completo</th>
            <th>Email</th>
            <th>Telefone</th>
            <th>Senha</th>
            <th>Data de Nascimento</th>
            <th>Editar</th>
        </tr>
        <?php
            foreach($array_dados_cliente as $cliente_dados){
                echo "<tr>
                    <td>{$cliente_dados[1]}</td>
                    <td>{$cliente_dados[2]}</td>
                    <td>{$cliente_dados[3]}</td>
                    <td>{$cliente_dados[4]}</td>
                    <td>{$cliente_dados[5]}</td>
                    <td><a href='cliente_editar.php?id_cliente=$cliente_dados[0]'><img src='icons/black-24dp/2x/outline_app_registration_black_24dp.png'></a></td>
                </tr>
                ";
            }
        ?>
    </table>
    <button><a href="?logout=1">Deslogar</a></button>