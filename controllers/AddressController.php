<?php

require_once 'operations/Address/AddressSearcher.php';
require_once 'database.php';

class AddressController {

    public function getAddress() {
        $db = new Database();

        var_dump($db);
        $operation = new AddressSearcher($db);
        $addresses = $operation->search();

        header('Content-Type: application/json');
        echo json_encode($addresses);
    }

    public function getAddressById() {
        $db = new Database();

        var_dump($db);
        $operation = new AddressSearcher($db);
        $addresses = $operation->search($_REQUEST['city_id']);

        header('Content-Type: application/json');
        echo json_encode($addresses);
    }

}
