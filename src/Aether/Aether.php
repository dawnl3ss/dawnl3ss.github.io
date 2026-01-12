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
 *  → https://github.com/dawnl3ss/Aether-PHP
 *
*/
declare(strict_types=1);

namespace Aether;

use Aether\Config\ProjectConfig;
use Aether\Middleware\Pipeline;
use Aether\Middleware\Stack\CsrfMiddleware;
use Aether\Modules\I18n\I18N;
use Aether\Modules\ModuleFactory;
use Aether\Router\Controller\ControllerGateway;

/*
 * Pure PHP 8.3+ framework built from scratch.
 *
 * Wanted a lightweight and fast alternative to other useless-as-hell and huge frameworks.
 * Easy to incorporate in SaaS, Webapps, REST APIs...
 *
 * Made by : Dawnless (Alexandre VOISIN)
 * → https://www.linkedin.com/in/alexvsn/
 * → https://dawnless.me
 * → https://hardware-hub.fr
 */
class Aether {

    /** @var string $_globalAppState */
    public static string $_globalAppState = "DEV";


    /**
     * Aether Core init function
     *
     * @return void
     */
    public static function _init() : void {

        # - Dev Env-related
        if (self::$_globalAppState == "DEV"){
            error_reporting(E_ALL);
            ini_set('display_errors', 1);
        }

        # - .Env File load
        ProjectConfig::_load();

        # - Cookies Security Fix
        session_set_cookie_params([
            'httponly' => true,
            'secure' => true,
            'samesite' => 'Strict'
        ]);

        # - Session
        ini_set('session.cookie_lifetime', 60 * 60 * 24 * 10);
        ini_set('session.gc_maxlifetime', 60 * 60 * 24 * 10);
        session_start();

        # - Modules load
        ModuleFactory::_load([
            I18N::class
        ]);

        # - Middleware
        Pipeline::_run([ CsrfMiddleware::class ], function (){
            # - Router Gateway : deliver correct controller for each route
            ControllerGateway::_link();
        });
    }
}