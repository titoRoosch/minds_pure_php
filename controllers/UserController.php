<?php

require_once '../operations/User/UserCreate.php';
require_once '../operations/User/UserDelete.php';
require_once '../operations/User/UserUpdate.php';
require_once '../operations/User/UserSearcher.php';

class UserController
{

    public function getUsers() {

        $db = new Database('localhost', 'dbname', 'username', 'password');

        $operation = new UserSearcher();
        $users = $operation->search();

        header('Content-Type: application/json');
        echo json_encode($addresses);
    }

    public function getUserById() {
        
        $operation = new UserSearcher();

        $user = $operation->search($req->user_id);

        header('Content-Type: application/json');
        echo json_encode($addresses);
    }

    public function createUser() {
        $params = $_REQUEST;
        $operation = new UserCreate($params);
        $users = $operation->create();

        header('Content-Type: application/json');
        echo json_encode($addresses);
    }

    public function updateUser() {
        $params = $_REQUEST;
        $operation = new UserUpdate($req->user_id);
        $users = $operation->update($params);

        header('Content-Type: application/json');
        echo json_encode($addresses);
    }

    public function deleteUser() {
        $params = $_REQUEST;
        $operation = new UserDelete();
        $users = $operation->delete($req->user_id);

        header('Content-Type: application/json');
        echo json_encode($addresses);
    }
}
