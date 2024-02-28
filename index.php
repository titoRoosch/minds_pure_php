<?php

spl_autoload_register(function ($className) {
    require_once 'controllers/' . $className . '.php';
});

function handleRoute($method, $uri) {

    $uriParts = explode('/', $uri);
    
    array_shift($uriParts);

    $controller = null;
    
    // Verificar o tipo de recurso da rota
    $resource = $uriParts[1];
    
    // Remover o tipo de recurso do início da URI
    array_shift($uriParts);
    
    // Se houver partes restantes na URI, a última parte deve ser o ID do recurso
    $resourceId = null;
    if (count($uriParts) == 2) {
        $resourceId = $uriParts[1];
    }

    // Verificar o método HTTP e definir o método do controlador apropriado
    switch ($method) {
        case 'GET':
            $method = 'get';
            break;
        case 'POST':
            $method = 'create';
            break;
        case 'PUT':
            $method = 'update';
            break;
        case 'DELETE':
            $method = 'delete';
            break;
        default:
            http_response_code(405);
            header('Content-Type: application/json');
            echo json_encode(array('message' => 'Método não permitido'));
            return;
    }
    
    // Definir o nome do método do controlador com base no método HTTP e no tipo de recurso
    $controllerMethod = $method . ucfirst($resource);

        
    if ($resourceId !== null) {
        $controllerMethod . 'byId';
    } 

    
    // Instanciar o controlador correspondente ao tipo de recurso
    switch ($resource) {
        case 'users':
            $controller = new UserController();
            break;
        case 'address':
            $controller = new AddressController();
            break;
        case 'state':
            $controller = new StateController();
            break;
        case 'city':
            $controller = new CityController();
            break;
        default:
            http_response_code(404);
            header('Content-Type: application/json');
            echo json_encode(array('message' => 'Rota não encontrada'));
            return;
    }

    
    // Verificar se o método do controlador existe e chamar
    if (method_exists($controller, $controllerMethod)) {
        // Se houver um ID de recurso, passe-o para o método do controlador
        if ($resourceId !== null) {
            $controllerMethod . 'byId';
            $controller->$controllerMethod($resourceId);
        } else {
            $controller->$controllerMethod();
        }
    } else {
        // Se o método do controlador não existir, retornar um erro 405
        http_response_code(405);
        header('Content-Type: application/json');
        echo json_encode(array('message' => 'Método não permitido'));
    }
}

$method = $_SERVER['REQUEST_METHOD'];
$uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);

handleRoute($method, $uri);
