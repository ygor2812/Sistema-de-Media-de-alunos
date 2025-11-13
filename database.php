<?php
require_once 'config.php';

class Database
{
    private static $instance = null;
    private $pdo;

    private function __construct()
    {
        try{
             $this->pdo = new PDO(dsn: DB_DSN);
             $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
             $this->pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
             $this->criarTabelas();
           } catch (PDOException $e){
                die("Erro na conexao".$e->getMessage());
           }  
    }
    public function getConnection(){
        return $this->pdo;
    }
    public static function getInstance(){
        if(self::$instance == null){
            self::$instance = new self();
        }
        return self::$instance;
    }
    private function criarTabelas(){ //funcao de criar tabelas
        $stmt = $this->pdo->query("SELECT name FROM sqlite_master WHERE type='table' AND name='users'");
        $tableExiste = $stmt->fetch()!== false;

        if(!$tableExiste){ //tabela de users
            $sql = "CREATE TABLE users(
                id INTEGER AUTO_INCREMENT PRIMARY KEY,
                nome VARCHAR(100)NOT NULL,
                email VARCHAR(100)UNIQUE NOT NULL,
                senha VARCHAR(255) NOT NULL
            )";
            $this->pdo->exec($sql);
        }

        $stmt = $this->pdo->query("SELECT name FROM sqlite_master WHERE type='table' AND name='alunos'");
        $tableexistis = $stmt->fetch()!== false;

        if(!$tableExiste){ //tabela alunos
            $sql = "CREATE TABLE alunos(
                    id INTEGER PRIMARY KEY AUTOINCREMENT,
                    nome VARCHAR(100) NOT NULL,
                    nota1 REAL NOT NULL CHECK (nota1>=0 AND nota1<=10),
                    nota2 REAL NOT NULL CHECK (nota2>=0 AND nota2<=10),
                    media REAL
            )";
            $this->pdo->exec($sql);
        }
    }  
}
$db = Database::getInstance();