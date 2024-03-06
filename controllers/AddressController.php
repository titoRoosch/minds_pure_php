<?php

require_once 'operations/Address/AddressSearcher.php';
require_once 'database.php';

class AddressController {

    public function getAddress() {
        $addressid = null;

        if(isset($_REQUEST['address_id'])){
            $addressid = $_REQUEST['address_id'];
        }

        $db = new Database();

        $operation = new AddressSearcher($db);
        $addresses = $operation->search($addressid);

        header('Content-Type: application/json');
        echo json_encode($addresses);
    }
}
