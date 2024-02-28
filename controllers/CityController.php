<?php

class CityController {
    public function handleRequest() {
        // Lógica para processar a requisição de /api/address
        // Por exemplo, você pode buscar endereços de um banco de dados ou de um serviço externo
        $addresses = array(
            array(
                'street' => 'Rua A',
                'city' => 'Barueri',
                'state' => 'Estado A'
            ),
            array(
                'street' => 'Rua B',
                'city' => 'Osasco',
                'state' => 'Estado B'
            )
        );

        // Retorna os endereços como uma resposta JSON
        header('Content-Type: application/json');
        echo json_encode($addresses);
    }
}
