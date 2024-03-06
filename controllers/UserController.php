<?php

require_once 'operations/User/UserCreate.php';
require_once 'operations/User/UserDelete.php';
require_once 'operations/User/UserUpdate.php';
require_once 'operations/User/UserSearcher.php';
require_once 'database.php';

class UserController
{

    public function getUsers() {

        $userid = null;

        if(isset($_REQUEST['user_id'])){
            $userid = $_REQUEST['user_id'];
        }

        $db = new Database();

        $operation = new UserSearcher($db);
        $users = $operation->search($userid);

        
        echo json_encode($users);
    }

    public function createUsers() {
        $body = file_get_contents('php://input');
        $params = json_decode($body, true);

        $db = new Database();

        $operation = new UserSearcher($db);
        $users = $operation->searchUserByEmail($params['email']);

        if(count($users) !== 0) {
            header('Content-Type: application/json');
            echo json_encode([
                'message' => 'e-mail já cadastrado para outro usuário',
                'user' => $users
            ]);
            return;
        }

        $operation = new UserCreate($db);
        $users = $operation->create($params);

        header('Content-Type: application/json');
        echo json_encode($users);
    }

    public function updateUsers() {
        $body = file_get_contents('php://input');
        $params = json_decode($body, true);

        $db = new Database();

        $operation = new UserSearcher($db);
        $users = $operation->search($params['user_id']);

        if(count($users) == 0) {
            header('Content-Type: application/json');
            echo json_encode([
                'message' => 'usuário não encontrado',
            ]);
            return;
        }

        $operation = new UserUpdate($db);
        $users = $operation->update($params);

        header('Content-Type: application/json');
        echo json_encode($users);
    }

    public function deleteUsers() {
        $userid = $_REQUEST['user_id'];

        $db = new Database();

        $operation = new UserSearcher($db);
        $users = $operation->search($userid);

        if(count($users) == 0) {
            header('Content-Type: application/json');
            echo json_encode([
                'message' => 'usuário não encontrado',
            ]);
            return;
        }

        $operation = new UserDelete($db);
        $users = $operation->delete($userid);

        header('Content-Type: application/json');
        echo json_encode($users);
    }
}
