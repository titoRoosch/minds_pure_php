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
        $query = "SELECT * FROM cities";

        // Se userid for fornecido, filtrar pelo ID do usuário
        if ($cityid !== null) {
            $query .= " WHERE id = :cityid";
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