<?php


class AddressSearcher
{
    private $pdo;

    public function __construct($pdo)
    {
        $this->pdo = $pdo;
    }

    public function search($addresid = null)
    {
        $param = [];
        $query = "SELECT a.*, c.name, s.name, s.acr 
        FROM addresses a 
        LEFT JOIN cities c on a.city_id = c.id
        LEFT JOIN states s on a.state_id = s.id";

        if ($addresid !== null) {
            $query .= " WHERE a.id = :addresid";
            $param = Array(':addresid' => $addresid);
        }

        return $this->pdo->query($query, $param);
    }
}