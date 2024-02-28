<?php

// Autoload para carregar classes automaticamente
spl_autoload_register(function ($className) {
    require_once 'controllers/' . $className . '.php';
});


switch ($_SERVER['REQUEST_URI']) {
    case '/api/address':
        $addressController = new AddressController();
        $addressController->getAddresses();
        break;

    case '/api/address/{address_id}':
        $addressController = new AddressController();
        $addressController->getAddresses();
        break;
    
    case '/api/city':
        $cityController = new CityController();
        $cityController->handleRequest();
        break;

    case '/api/users':
        $addressController = new UserController();
        $addressController->getUsers();
        break;

    
    default:
        http_response_code(404);
        header('Content-Type: application/json');
        echo json_encode(array('message' => 'Rota não encontrada'));
}


