<?php


class AddressSearcher
{
    private $pdo;

    public function __construct(PDO $pdo)
    {
        $this->pdo = $pdo;
    }

    public function search($addresid = null)
    {
        $query = "SELECT * FROM addresses";

        // Se userid for fornecido, filtrar pelo ID do usuário
        if ($addresid !== null) {
            $query .= " WHERE id = :addresid";
            $statement = $this->pdo->prepare($query);
            $statement->bindParam(':addresid', $addresid, PDO::PARAM_INT);
        } else {
            $statement = $this->pdo->prepare($query);
        }

        $statement->execute();
        $results = $statement->fetchAll(PDO::FETCH_ASSOC);

        return $results;
    }
}