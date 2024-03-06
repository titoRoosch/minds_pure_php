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
        $param = [];

        $query = "SELECT u.*, a.street, a.postal_code, a.complement, c.name, s.name, s.acr 
        FROM users u 
        LEFT JOIN addresses a on u.address_id = a.id
        LEFT JOIN cities c on u.city_id = c.id
        LEFT JOIN states s on u.state_id = s.id
        ";

        if ($userid !== null) {
            $query .= " WHERE u.id = :userid";
            $param = Array(':userid' => $userid);
        } 

        return $this->pdo->query($query, $param);
    }

    public function searchUserByEmail($email) {

        $query = "SELECT * FROM users WHERE email = :email";

        $param = [];
        $param[':email'] = $email;

        return $this->pdo->query($query, $param);
    }
}