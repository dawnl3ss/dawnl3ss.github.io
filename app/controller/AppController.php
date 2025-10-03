<?php

require_once $_SERVER["DOCUMENT_ROOT"] . "/vendors/Zephyr/app.php";
require_once $_SERVER["DOCUMENT_ROOT"] . "/app/Autoloader.php";
__load_all_classes();

class AppController {

    public function _route(){

        create_route(METHOD_GET, '/', function(){
            $projects = Wrapper::_load_projects();
            require_once "views/home.view.php";
        });

        create_route(METHOD_GET, '/projects/{project_name}', function($project_name){
            $route = '/' . htmlspecialchars($project_name);

            foreach (Wrapper::_load_projects() as $project_type => $projects){
                foreach ($projects as $project){
                    if ($project instanceof Project && strtolower($project->_get_route()) == strtolower($route))
                        var_dump($project);
                }
            }
        });

        create_route(METHOD_GET, '/writeups', function(){
            require_once "views/writeups.view.php";
        });


        create_route(METHOD_GET, '/writeups/{each}', function($platform){
            $wt = Wrapper::_load_writeups()[$platform];
            $platform = $platform;
            if (!in_array($platform, ["hackthebox", "tryhackme"])){
                header("Location: /writeups");
                return;
            }
            require_once "views/writeups/each.view.php";
        });

        load_routes();
    }
}