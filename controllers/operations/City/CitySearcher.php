<?php


class CitySearcher
{
    private $pdo;

    public function __construct($pdo)
    {
        $this->pdo = $pdo;
    }

    public function search($cityid = null)
    {
        $param = [];
        $query = "SELECT c.*, s.name, s.acr  FROM cities c LEFT JOIN states s on s.id  = c.state_id ";

        if ($cityid !== null) {
            $query .= " WHERE c.id = :cityid";
            $param = Array(':cityid' => $cityid);
        }

        return $this->pdo->query($query, $param);
    }
}