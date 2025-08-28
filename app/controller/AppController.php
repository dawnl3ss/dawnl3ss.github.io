<?php

require_once $_SERVER["DOCUMENT_ROOT"] . "/vendors/Zephyr/app.php";
require_once $_SERVER["DOCUMENT_ROOT"] . "/app/Autoloader.php";
__load_all_classes();

class AppController {

    public function _route(){

        create_route(METHOD_GET, '/', function(){
            require_once "views/home.view.php";
        });

        create_route(METHOD_GET, '/writeups', function(){
            echo "Writeups";
        });

        load_routes();
    }
}