<?php


class StateSearcher
{
    private $pdo;

    public function __construct($pdo)
    {
        $this->pdo = $pdo;
    }

    public function search($stateid = null)
    {
        $param = [];
        $query = "SELECT * FROM states";

        if ($stateid !== null) {
            $query .= " WHERE id = :stateid";
            $param = Array(':stateid' => $stateid);
        }

        return $this->pdo->query($query, $param);
    }
}