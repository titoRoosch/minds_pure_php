<?php


class CitySearcher
{
    private $pdo;

    public function __construct(PDO $pdo)
    {
        $this->pdo = $pdo;
    }

    public function search($cityid = null)
    {
        $query = "SELECT c.*, s.name, s.acr  FROM cities c LEFT JOIN states s on s.id  = c.state_id ";

        // Se userid for fornecido, filtrar pelo ID do usuário
        if ($cityid !== null) {
            $query .= " WHERE c.id = :cityid";
            $statement = $this->pdo->prepare($query);
            $statement->bindParam(':cityid', $cityid, PDO::PARAM_INT);
        } else {
            $statement = $this->pdo->prepare($query);
        }

        $statement->execute();
        $results = $statement->fetchAll(PDO::FETCH_ASSOC);

        return $results;
    }
}