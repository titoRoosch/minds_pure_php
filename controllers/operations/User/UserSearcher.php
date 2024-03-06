<?php


class UserSearcher
{
    private $pdo;

    public function __construct( $pdo)
    {
        $this->pdo = $pdo;
    }

    public function search($userid = null)
    {
        $host='db'; $port='3306'; $dbname='pure_minds'; $username='user'; $password='my_password';
        $dsn = "mysql:host=$host;port=$port;dbname=$dbname;charset=utf8mb4";
        $this->pdo = new PDO($dsn, $username, $password);

        $query = "SELECT u.*, a.street, a.postal_code, a.complement, c.name, s.name, s.acr 
        FROM users u 
        LEFT JOIN addresses a on u.address_id = a.id
        LEFT JOIN cities c on u.city_id = c.id
        LEFT JOIN states s on u.state_id = s.id
        ";

        // Se userid for fornecido, filtrar pelo ID do usuário
        if ($userid !== null) {
            $query .= " WHERE u.id = :userid";
            $statement = $this->pdo->prepare($query);
            $statement->bindParam(':userid', $userid, PDO::PARAM_INT);
        } else {
            $statement = $this->pdo->prepare($query);
        }

        $statement->execute();
        $results = $statement->fetchAll(PDO::FETCH_ASSOC);

        return $results;
    }
}