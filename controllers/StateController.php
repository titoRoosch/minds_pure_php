<?php

class AddressController {

    public function getState() {
        $addresses = array(
            array(
                'street' => 'Rua A',
                'city' => 'Cidade A',
                'state' => 'Estado A'
            ),
            array(
                'street' => 'Rua B',
                'city' => 'Cidade B',
                'state' => 'Estado B'
            )
        );

        // Retorna os endereços como uma resposta JSON
        header('Content-Type: application/json');
        echo json_encode($addresses);
    }

    public function getStateById() {
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
