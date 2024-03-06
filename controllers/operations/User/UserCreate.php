<?php

class UserCreate
{
    protected $pdo;

    public function __construct($pdo) {
        $this->pdo = $pdo;
    }

    public function create($params) : array
    {
        try {
            $user = $this->createUser($params);
    
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


    private function createUser($params) {
        $query = "INSERT INTO users (email, name, password, address_id, city_id, state_id) 
                  VALUES (:email, :name, :password, :address_id, :city_id, :state_id)";
        
        $paramsQuery = Array();
        $paramsQuery[':email'] = $params['email'];
        $paramsQuery[':name'] = $params['name'];
        $paramsQuery[':password'] = $params['password'];
        $paramsQuery[':address_id'] = $params['address_id'];
        $paramsQuery[':city_id'] = $params['city_id'];
        $paramsQuery[':state_id'] = $params['state_id'];
        
        return $this->pdo->query($query, $paramsQuery);
    }
}
