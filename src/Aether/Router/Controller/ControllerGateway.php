<?php

/*
 *
 *      █████╗ ███████╗████████╗██╗  ██╗███████╗██████╗         ██████╗ ██╗  ██╗██████╗
 *     ██╔══██╗██╔════╝╚══██╔══╝██║  ██║██╔════╝██╔══██╗        ██╔══██╗██║  ██║██╔══██╗
 *     ███████║█████╗     ██║   ███████║█████╗  ██████╔╝ █████╗ ██████╔╝███████║██████╔╝
 *     ██╔══██║██╔══╝     ██║   ██╔══██║██╔══╝  ██╔══██╗ ╚════╝ ██╔═══╝ ██╔══██║██╔═══╝
 *     ██║  ██║███████╗   ██║   ██║  ██║███████╗██║  ██║        ██║     ██║  ██║██║
 *     ╚═╝  ╚═╝╚══════╝   ╚═╝   ╚═╝  ╚═╝╚══════╝╚═╝  ╚═╝        ╚═╝     ╚═╝  ╚═╝╚═╝
 *
 *                      The divine lightweight PHP framework
 *                  < 1 Mo • Zero dependencies • Pure PHP 8.3+
 *
 *  Built from scratch. No bloat. POO Embedded.
 *
 *  @author: dawnl3ss (Alex') ©2025 — All rights reserved
 *  Source available • Commercial license required for redistribution
 *  → github.com/dawnl3ss/Aether-PHP
 *
*/
declare(strict_types=1);

namespace Aether\Router\Controller;

use Aether\Router\Router;
use \ReflectionClass;
use \ReflectionException;
use \ReflectionMethod;


final class ControllerGateway {

    /**
     * Router => Controller Gateway | & API integration
     */
    public static function _link() : void {
        $directory = __DIR__ . '/../../../../app/App/Controller/*.php';
        $controllerFiles = glob($directory);
        $router = new Router();

        foreach ($controllerFiles as $file){
            $class_name = 'App\Controller\\' . pathinfo($file, PATHINFO_FILENAME);

            try {
                $reflection = new ReflectionClass($class_name);
            } catch (ReflectionException $e){
                echo "[ControllerGateway] - ERROR - Cannot reflect class $class_name: " . $e->getMessage();
                continue;
            }

            foreach ($reflection->getMethods(ReflectionMethod::IS_PUBLIC) as $method){
                $doc = $method->getDocComment();
                if (!$doc) continue;

                $method_type = self::extractAnnotation($doc, 'method');
                $route = self::extractAnnotation($doc, 'route');

                if (!$method_type || !$route){
                    echo "[ControllerGateway] - ERROR - Wrong PHP Doc for {$class_name} Controller, method {$method->getName()}";
                    continue;
                }

                $router->_addRoute(strtoupper($method_type), $route, "{$class_name}@{$method->getName()}");
            }
        }

        $directory = __DIR__ . '/../../../../app/App/Controller/Api/*.php';
        $controllerFiles = glob($directory);

        foreach ($controllerFiles as $file){
            $class_name = 'App\Controller\Api\\' . pathinfo($file, PATHINFO_FILENAME);

            try {
                $reflection = new ReflectionClass($class_name);
            } catch (ReflectionException $e){
                echo "[ControllerGateway] - ERROR - Cannot reflect class $class_name: " . $e->getMessage();
                continue;
            }

            foreach ($reflection->getMethods() as $method){
                $doc = $method->getDocComment();
                if (!$doc) continue;

                $method_type = self::extractAnnotation($doc, 'method');
                $route = self::extractAnnotation($doc, 'route');

                if (!$method_type || !$route){
                    echo "[ControllerGateway] - ERROR - Wrong PHP Doc for {$class_name} Controller, method {$method->getName()}";
                    continue;
                }

                $router->_addRoute(strtoupper($method_type), $route, "{$class_name}@{$method->getName()}");
            }
        }

        $router->_run();
    }

    /**
     *
     *
     * @param string $docComment
     *
     * @param string $annotation
     *
     * @return string|null
     */
    private static function extractAnnotation(string $docComment, string $annotation) : ?string {
        if (preg_match("/\\[@{$annotation}\\]\\s*=>\\s*(\\S+)/", $docComment, $matches))
            return $matches[1];

        return null;
    }
}
