<?php

require_once 'operations/Address/AddressSearcher.php';
require_once 'database.php';

class AddressController {

    public function getAddress() {
        echo 'teste';
        $db = new Database();

        var_dump($db);
        $operation = new AddressSearcher($db);
        $addresses = $operation->search();

        header('Content-Type: application/json');
        echo json_encode($addresses);
    }

    public function getAddressById() {
        $addresses = array(
            array(
                'street' => 'Rua A',
                'city' => 'Cidade A',
                'state' => 'Estado A'
            ),

        );

        // Retorna os endereços como uma resposta JSON
        header('Content-Type: application/json');
        echo json_encode($addresses);
    }

}
