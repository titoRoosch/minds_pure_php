<?php

class UserDelete {
    
    protected $pdo;

    public function __construct($pdo) {
        $this->pdo = $pdo;
    }

    public function delete($userid)
    {

        try {
            $user = $this->deleteUser($userid);
    
            return [
                'message' => 'usuário deletado com sucesso',
                'user' => $user
            ];
        } catch(Exception $e) {
            return [
                'message' => 'erro ao deletar usuário',
                'error' => $e->getMessage()
            ];
        }
    }


    private function deleteUser($userid) {

        $query = "DELETE FROM users WHERE id = :userid";
        
        $paramsQuery = Array(':userid' => $userid);
    
        return $this->pdo->query($query, $paramsQuery);    
    }
}