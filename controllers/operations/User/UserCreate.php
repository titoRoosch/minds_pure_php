<?php

class UserCreate
{
    protected $params;
    protected $pdo;

    public function __construct($params, $pdo) {
        $this->params = $params;
        $this->pdo = $pdo;
    }

    public function create() : array
    {
        $search = $this->searchUser($this->params['email'], $this->params['name']);

        if(count($search) !== 0) {
            return [
                'message' => 'e-mail já cadastrado para outro usuário',
                'user' => $search
            ];
        }

        try {
            $user = $this->createUser($this->params);
    
            return [
                'message' => 'usuário cadastrado com sucesso',
                'user' => $user
            ];
        } catch(Exception $e) {
            return [
                'message' => 'erro ao cadastrar usuário',
                'error' => $e->getMessage()
            ];
        }
    }

    private function searchUser($email, $name) {

        $query = "SELECT * FROM users WHERE email = :email";

        $statement = $this->pdo->prepare($query);
        $statement->bindParam(':email', $params['email']);

        $statement->execute();
        $results = $statement->fetchAll(PDO::FETCH_ASSOC);
        return $results;
    }

    private function createUser($params) {
        $query = "INSERT INTO users (email, name, password, address_id, city_id, state_id) 
                  VALUES (:email, :name, :password, :address_id, :city_id, :state_id)";
        
        $statement = $this->pdo->prepare($query);
        $statement->bindParam(':email', $params['email']);
        $statement->bindParam(':name', $params['name']);
        $statement->bindParam(':password', $params['password']);
        $statement->bindParam(':address_id', $params['address_id']);
        $statement->bindParam(':city_id', $params['city_id']);
        $statement->bindParam(':state_id', $params['state_id']);
        
        $statement->execute();

        return [
            'email' => $params['email'],
            'name' => $params['name'],
            'address_id' => $params['address_id'],
            'city_id' => $params['city_id'],
            'state_id' => $params['state_id']
        ];
    }
}
