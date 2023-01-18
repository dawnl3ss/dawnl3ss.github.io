<?php

require_once __DIR__ . "/../../vendor/zephyr/app.php";

function __acces(){
    create_routes(
        [
            [
                "method" => METHOD_GET,
                "name" => "/",
                "callback" => function(){
                    require_once "view/index.view.html";
                }
            ],
        ]
    );
    load_routes();
}