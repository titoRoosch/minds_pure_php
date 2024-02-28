<?php

require_once 'operations/User/UserCreate.php';
require_once 'operations/User/UserDelete.php';
require_once 'operations/User/UserUpdate.php';
require_once 'operations/User/UserSearcher.php';
require_once 'database.php';

class UserController
{

    public function getUsers() {

        $db = new Database();

        $operation = new UserSearcher($db);
        $users = $operation->search();

        header('Content-Type: application/json');
        echo json_encode($users);
    }

    public function getUserById() {
        
        $db = new Database();
        $operation = new UserSearcher();

        $user = $operation->search($_REQUEST['user_id']);

        header('Content-Type: application/json');
        echo json_encode($user);
    }

    public function createUser() {
        $db = new Database();
        $params = $_REQUEST;
        $operation = new UserCreate($params);
        $users = $operation->create();

        header('Content-Type: application/json');
        echo json_encode($users);
    }

    public function updateUser() {
        $db = new Database();
        $params = $_REQUEST;
        $operation = new UserUpdate($_REQUEST['user_id']);
        $users = $operation->update($params);

        header('Content-Type: application/json');
        echo json_encode($users);
    }

    public function deleteUser() {
        $db = new Database();
        $params = $_REQUEST;
        $operation = new UserDelete();
        $users = $operation->delete($_REQUEST['user_id']);

        header('Content-Type: application/json');
        echo json_encode($users);
    }
}
