<?php

require_once 'operations/City/CitySearcher.php';
require_once 'database.php';

class CityController {
    public function getCity() {
        $db = new Database();

        $operation = new CitySearcher($db);
        $city = $operation->search();

        header('Content-Type: application/json');
        echo json_encode($city);
    }

    public function getCityById() {
        $db = new Database();

        $operation = new CitySearcher($db);
        $city = $operation->search();

        header('Content-Type: application/json');
        echo json_encode($city);
    }
}
