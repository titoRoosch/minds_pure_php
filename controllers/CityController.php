<?php

require_once 'operations/City/CitySearcher.php';
require_once 'database.php';

class CityController {
    public function getCity() {
        $cityid = null;

        if(isset($_REQUEST['city_id'])){
            $cityid = $_REQUEST['city_id'];
        }


        $db = new Database();

        $operation = new CitySearcher($db);
        $city = $operation->search($cityid);

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
