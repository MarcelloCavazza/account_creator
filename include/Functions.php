<?php
    include_once "Conection.php";
    class Funcoes extends Conexao{
        public function listar($id): array{
            try{
                $verf_array_dados_cliente = $this->connection->prepare("SELECT * FROM clientes where id_cliente = '{$id}';");
                $verf_array_dados_cliente->execute();
                if($verf_array_dados_cliente->rowCount() > 0){
                    return $verf_array_dados_cliente->fetchAll();   
                }
            }catch(PDOException $e){
                echo "Incompatibilidade de dados inseridos com a do banco de dados: {$e}";
            }
        }
        public function getId($usuario,$senha):array{
            try{
                $verf_array_dados_cliente = $this->connection->prepare("SELECT id_cliente FROM clientes where email_cliente = '{$usuario}' and senha_cliente = '{$senha}';");
                $verf_array_dados_cliente->execute();
                if($verf_array_dados_cliente->rowCount() > 0){
                    return $verf_array_dados_cliente->fetchAll();   
                }
            }catch(PDOException $e){
                echo "Incompatibilidade de dados inseridos com a do banco de dados: {$e}";
            }
        }
        public function verificar($usuario,$senha){
            try{
                $verf_array_dados_cliente = $this->connection->prepare("SELECT * FROM clientes where email_cliente = '{$usuario}' and senha_cliente = '$senha';");
                $verf_array_dados_cliente->execute();
                if($verf_array_dados_cliente->rowCount() > 0){
                    $_SESSION['logged'] = True;
                    return $verf_array_dados_cliente->fetchAll();   
                }
            }catch(PDOException $e){
                echo "Incompatibilidade de dados inseridos com a do banco de dados: {$e}";
            }
        }
        public function cadastrar(string $nome_cliente, string $email_cliente, string $telefone_cliente, string $senha_cliente, string $data_nasc_cliente): bool{
            try{
                $nome_cliente = $nome_cliente;
                $email_cliente = $email_cliente;
                $telefone_cliente = $telefone_cliente;
                $senha_cliente = $senha_cliente;
                $data_nasc_cliente = $data_nasc_cliente;
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
                echo "Erro: {$e}";
                return false;
            }
        }
        public function atualizar(){
            try{
                    $this->nome_cliente = $_POST['nome_cliente'];
                    $this->email_cliente = $_POST['email_cliente'];
                    $this->telefone_cliente = $_POST['telefone_cliente'];
                    $this->senha_cliente = $_POST['senha_cliente'];
                    $this->data_nasc_cliente = $_POST['data_nasc_cliente'];

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
                echo "Incompatibilidade de dados inseridos com a do banco de dados: {$e}";
                return false;
            }
        }

    }
?>