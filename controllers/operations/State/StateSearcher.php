<?php


class StateSearcher
{
    private $pdo;

    public function __construct(PDO $pdo)
    {
        $this->pdo = $pdo;
    }

    public function search($stateid = null)
    {
        $query = "SELECT * FROM states";

        if ($stateid !== null) {
            $query .= " WHERE id = :stateid";
            $statement = $this->pdo->prepare($query);
            $statement->bindParam(':stateid', $stateid, PDO::PARAM_INT);
        } else {
            $statement = $this->pdo->prepare($query);
        }

        $statement->execute();
        $results = $statement->fetchAll(PDO::FETCH_ASSOC);

        return $results;
    }
}