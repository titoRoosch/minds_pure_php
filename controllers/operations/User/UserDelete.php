<?php

class UserDelete {
    
    protected $params;
    protected $pdo;

    public function __construct($params, $pdo) {
        $this->params = $params;
        $this->pdo = $pdo;
    }

    public function delete()
    {
        $search = $this->searchUser($this->params['user_id']);

        if(count($search) == 0) {
            return [
                'message' => 'usuário não existente',
                'user' => $search
            ];
        }

        try {
            $user = $this->deleteUser($this->params);
    
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

    private function deleteUser($userid) {

        $query = "DELETE FROM users WHERE id = :userid";
        
        $statement = $this->pdo->prepare($query);
        $statement->bindParam(':userid', $userid);
        
        $statement->execute();

        return [
            'user_id' => $userid
        ];
    }
}