<?php


class UserSearcher
{
    private $pdo;

    public function __construct(PDO $pdo)
    {
        $this->pdo = $pdo;
    }

    public function search($userid = null)
    {
        $query = "SELECT * FROM users";

        // Se userid for fornecido, filtrar pelo ID do usuário
        if ($userid !== null) {
            $query .= " WHERE id = :userid";
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