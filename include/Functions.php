<?php
    include_once "Conection.php";
    //contem todas as funcoes utilizados do site.
    class Funcoes extends Conexao{
        //lista os dados do cliente, pesquisando sua ID no banco de dados.
        public function listar($id): array{
            try{
                $query = $this->connection->prepare("SELECT * FROM clientes where id_cliente = :id_cliente");
                $query_parametro = ['id_cliente' =>$id];
                $query->execute($query_parametro);
                if($query->rowCount() > 0){
                    return $query->fetchAll();   
                }
            }catch(PDOException $e){
                echo "Nao foi possivel listar os dados: {$e}";
            }
        }
        //funcao para verificar se algum dos valores inseridos p/ criar conta já existem
        public function verificarSeJaExiste($email,$telefone): int{
            try{
                $resultado =0;
                $query = $this->connection->prepare("SELECT * FROM clientes where email_cliente = :email_cliente");
                $query_parametro = ['email_cliente'=>$email];
                $query->execute($query_parametro);
                if($query->rowCount() > 1){
                    $resultado += 2;
                }
    
                $query = $this->connection->prepare("SELECT * FROM clientes where telefone_cliente = :telefone_cliente");
                $query_parametro = ['telefone_cliente'=>$telefone];
                $query->execute($query_parametro);
                if($query->rowCount() > 1){
                    $resultado += 4;
                }
                return $resultado;
            }catch(PDOException $e){
                echo "Nao foi possivel verificar se já existe email e telefone: {$e}";
            }
        }
        //deleta a conta
        public function deletarConta($id){
            try{
                $query = $this->connection->prepare("DELETE FROM clientes where id_cliente = :id_cliente");
                $query_parametro = ['id_cliente'=>$id];
                $query->execute($query_parametro);
                if($query->rowCount() > 0){
                    $_SESSION = array();
                    session_destroy();
                    return true;
                }
            }catch(PDOException $e){
                echo "Nao foi possivel deletar a conta: {$e}";
            }
        }   
        //pega o ID do usuario, usado na tela de login e na tela de cadastro para outras funcoes funcionarem.
        public function getId($usuario,$senha):array{
            try{
                $verf_array_dados_cliente = $this->connection->prepare("SELECT id_cliente FROM clientes where email_cliente = '{$usuario}' and senha_cliente = '{$senha}'");
                $verf_array_dados_cliente->execute();
                if($verf_array_dados_cliente->rowCount() > 0){
                    return $verf_array_dados_cliente->fetchAll();   
                }
            }catch(PDOException $e){
                echo "Nao foi possivel pegar o Id do usuario atual: {$e}";
            }
        }
        //usada para verificar se existe o email e senha inseridos na tela de login,
        // e aproveita e já deixa a sessao do usuario como logado e poder usar o site.
        public function verificar($usuario,$senha){
            try{
                $verf_array_dados_cliente = $this->connection->prepare("SELECT * FROM clientes where email_cliente = '{$usuario}' and senha_cliente = '{$senha}'");
                $verf_array_dados_cliente->execute();
                if($verf_array_dados_cliente->rowCount() > 0){
                    $_SESSION['logged'] = True;
                    return $verf_array_dados_cliente->fetchAll();   
                }
            }catch(PDOException $e){
                echo "Nao foi possivel verificar se existe ja a conta na tela de login: {$e}";
            }
        }
        //cadastra o usuario.
        public function cadastrar(string $nome_cliente, string $email_cliente, string $telefone_cliente, string $senha_cliente, string $data_nasc_cliente): bool{
            try{
                $nome_cliente = $nome_cliente;
                $email_cliente = $email_cliente;
                $telefone_cliente = $telefone_cliente;
                $senha_cliente = $senha_cliente;
                $data_nasc_cliente = $data_nasc_cliente;
                //usando tática para evitar sql injection 
                $query = $this->connection->prepare("insert into clientes values(NULL, 
                :nome_cliente, 
                :email_cliente, 
                :telefone_cliente, 
                :senha_cliente, 
                :data_nasc_cliente)");
                $query_parametro = ['nome_cliente' => $nome_cliente,'email_cliente'=>$email_cliente,
                'telefone_cliente'=>$telefone_cliente,'senha_cliente'=>$senha_cliente,'data_nasc_cliente'=>$data_nasc_cliente];
                $query->execute($query_parametro);
                return true;
            }
            catch(Exception $e){
                echo "erro no cadastro: {$e}";
                return false;
            }
        }
        //atualiza os dados do usuário.
        public function atualizar(){
            try{
                    $this->nome_cliente = $_POST['nome_cliente'];
                    $this->email_cliente = $_POST['email_cliente'];
                    $this->telefone_cliente = $_POST['telefone_cliente'];
                    $this->senha_cliente = $_POST['senha_cliente'];
                    $this->data_nasc_cliente = $_POST['data_nasc_cliente'];
                    //usando tática para evitar sql injection
                    $query = $this->connection->prepare("update clientes set nome_cliente = :nome_cliente,
                    email_cliente = :email_cliente,
                    telefone_cliente = :telefone_cliente,
                    senha_cliente = :senha_cliente,
                    data_nasc_cliente = :data_nasc_cliente where id_cliente = {$_SESSION['id']}");
                    $query_parametro = ['nome_cliente' => $this->nome_cliente,
                    'email_cliente'=>$this->email_cliente,
                    'telefone_cliente'=>$this->telefone_cliente,
                    'senha_cliente'=>$this->senha_cliente,
                    'data_nasc_cliente'=>$this->data_nasc_cliente];
                    $query->execute($query_parametro);
                    return true;
            }catch(PDOException $e){
                echo "Nao foi possivel atualizar sua conta: {$e}";
                return false;
            }
        }
    }
?>