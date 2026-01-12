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


spl_autoload_register(function ($class){

    # - Aether Core
    if (str_starts_with($class, 'Aether\\')) {

        # - Aether Modules
        if (str_starts_with($class, 'Aether\\Modules\\')){
            if (preg_match('/^Aether\\\\Modules\\\\([^\\\\]+)\\\\(.+)$/', $class, $matches)){
                $file = __DIR__ . '/src/Aether/Modules/' . $matches[1] . '/src/' . str_replace('\\', '/', $matches[2]) . '.php';
                if (file_exists($file)) return require_once $file;
            }
        }

        $file = __DIR__ . '/src/' . str_replace('\\', '/', $class) . '.php';
        if (file_exists($file)) return require_once $file;

    }

    # - Custom App Backend
    if (str_starts_with($class, 'App\\')) {
        $file = __DIR__ . '/app/' . str_replace('\\', '/', $class) . '.php';
        if (file_exists($file)) return require_once $file;
    }

    # - Testing folder
    if (str_starts_with($class, 'testing\\')) {
        $file = __DIR__ . '/' . str_replace('\\', '/', $class) . '.php';
        if (file_exists($file)) return require_once $file;
    }
});
