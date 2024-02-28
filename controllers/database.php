<?php

class Database
{
    private $pdo;

    public function __construct($host='localhost', $port='3303', $dbname='pure_minds', $username='user', $password='my_password')
    {
        // Configuração da conexão PDO
        $dsn = "mysql:host=$host;port=$port;dbname=$dbname;charset=utf8mb4";
    
        // Tentativa de conexão
        try {
            $this->pdo = new PDO($dsn, $username, $password);
            // Configuração de opções para lançar exceções em caso de erro
            $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            // Em caso de falha na conexão, tratar o erro
            throw new Exception("Erro ao conectar ao banco de dados: " . $e->getMessage());
        }
    }

    // Método para executar uma consulta SQL e retornar os resultados
    public function query($sql, $params = [])
    {
        try {
            $statement = $this->pdo->prepare($sql);
            $statement->execute($params);
            return $statement->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            throw new Exception("Erro ao executar a consulta: " . $e->getMessage());
        }
    }

    // Método para executar uma consulta SQL que não retorna resultados
    public function execute($sql, $params = [])
    {
        try {
            $statement = $this->pdo->prepare($sql);
            $statement->execute($params);
        } catch (PDOException $e) {
            throw new Exception("Erro ao executar a consulta: " . $e->getMessage());
        }
    }
}
