<?php

require_once 'operations/State/StateSearcher.php';
require_once 'database.php';

class StateController {

    public function getState() {

        $stateid = null;

        if(isset($_REQUEST['state_id'])){
            $stateid = $_REQUEST['state_id'];
        }

        $db = new Database();

        $operation = new StateSearcher($db);
        $states = $operation->search($stateid);

        header('Content-Type: application/json');
        echo json_encode($states);
    }
}
