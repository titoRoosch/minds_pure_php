<?php

class UserUpdate {
    
    protected $params;
    protected $pdo;

    public function __construct($params, $pdo) {
        $this->params = $params;
        $this->pdo = $pdo;
    }

    public function update()
    {
        $search = $this->searchUser($this->params['user_id']);

        if(count($search) == 0) {
            return [
                'message' => 'usuário não existente',
                'user' => $search
            ];
        }

        try {
            $user = $this->updateUser($this->params, $search);
    
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

    private function searchUser($userid) {

        $query = "SELECT * FROM users WHERE id = :userid";

        $statement = $this->pdo->prepare($query);
        $statement->bindParam(':userid', $params['userid']);

        $statement->execute();
        $results = $statement->fetchAll(PDO::FETCH_ASSOC);
        return $results;
    }

    private function updateUser($params, $user)
    {
        $updateQuery = "UPDATE users 
                        SET name = COALESCE(:name, name),
                            address_id = COALESCE(:address_id, address_id),
                            city_id = COALESCE(:city_id, city_id),
                            state_id = COALESCE(:state_id, state_id)
                        WHERE id = :id";

        $updateStatement = $pdo->prepare($updateQuery);
        $updateStatement->bindParam(':id', $this->user_id);
        $updateStatement->bindParam(':name', $params['name']);
        $updateStatement->bindParam(':address_id', $params['address_id']);
        $updateStatement->bindParam(':city_id', $params['city_id']);
        $updateStatement->bindParam(':state_id', $params['state_id']);

        $updateStatement->execute();

        return [
            'user_id' => $this->user_id,
            'name' => $params['name'],
            'address_id' => $params['address_id'],
            'city_id' => $params['city_id'],
            'state_id' => $params['state_id']
        ];
    }
}