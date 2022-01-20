<?php 
//conexao com o banco de dados
    class Conexao{
        private $data = ["host" => "127.0.0.1",
        "database" => "formsphp",
        "user" => "root",
        "password" => ""];
        protected $connection;
        public function __construct()
        {
            try{
                $this->connection = new PDO("mysql:host={$this->data['host']};dbname={$this->data['database']};charset=utf8", $this->data["user"], $this->data["password"]);
            }
            catch(Exception $e){
                echo "Erro: {$e}\n";
                die();
            }
        }
    }
?>