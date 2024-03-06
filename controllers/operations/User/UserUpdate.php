<?php

class UserUpdate {
    
    protected $pdo;

    public function __construct($pdo) {
        $this->pdo = $pdo;
    }

    public function update($params)
    {
        try {
            $user = $this->updateUser($params);
    
            return [
                'message' => 'usuário atualizado com sucesso',
                'user' => $user
            ];
        } catch(Exception $e) {
            return [
                'message' => 'erro ao atualizar usuário',
                'error' => $e->getMessage()
            ];
        }

    }

    private function updateUser($params)
    {
        $query = "UPDATE users 
                        SET name = COALESCE(:name, name),
                            address_id = COALESCE(:address_id, address_id),
                            city_id = COALESCE(:city_id, city_id),
                            state_id = COALESCE(:state_id, state_id)
                        WHERE id = :id";

        $paramsQuery = Array();
        $paramsQuery[':id'] = $params['user_id'];
        $paramsQuery[':name'] = $params['name'];
        $paramsQuery[':address_id'] = $params['address_id'];
        $paramsQuery[':city_id'] = $params['city_id'];
        $paramsQuery[':state_id'] = $params['state_id'];
        
        return $this->pdo->query($query, $paramsQuery);
    }
}