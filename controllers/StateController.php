<?php

require_once 'operations/State/StateSearcher.php';
require_once 'database.php';

class AddressController {

    public function getState() {

        $stateid = null;

        if(isset($_REQUEST['state_id'])){
            $stateid = $_REQUEST['state_id'];
        }

        $db = new Database();

        $operation = new StateSearcher($db);
        $users = $operation->search($stateid);

        header('Content-Type: application/json');
        echo json_encode($addresses);
    }

    public function getStateById() {
        $db = new Database();

        $operation = new StateSearcher($db);
        $users = $operation->search($_REQUEST['state_id']);

        header('Content-Type: application/json');
        echo json_encode($addresses);
    }

}
