<?php

namespace Aether\Modules\AetherCLI\Command\List;

use Aether\IO\IOFile;
use Aether\IO\IOTypeEnum;
use Aether\Modules\AetherCLI\Cli\CliColorEnum;
use Aether\Modules\AetherCLI\Command\Command;

class MakeCommand extends Command {

    public function __construct(array $_extra){
        parent::__construct(
            "make",
            [ "controller", "file", "folder" ],
            $_extra,
            "./aether make:[controller|file|folder] {name}"
        );
    }

    public function _execute(?string $_prototype) : bool {
        if (is_null($_prototype))
            die(CliColorEnum::FG_RED->_paint("[MakeCommand] - Error - Missing argument(s).") . PHP_EOL);

        # - Controller prototype
        if ($_prototype === "controller"){
            if ($this->_getExtra() === [])
                die(CliColorEnum::FG_RED->_paint("[MakeCommand:Controller] - Error - Missing controller name.") . PHP_EOL);

            $path = $this->_getExtra()[0];
            $pathlower = strtolower($path);

            $name = explode("/", $path)[count(explode("/", $path))-1];
            $lower = strtolower($name);

            $baseControllerContent = <<<'PHP'
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
            
            namespace App\Controller;
            
            use Aether\Router\Controller\Controller;
            
            
            class {{CLASSNAME}} extends Controller {
            
                /**
                 * [@method] => GET
                 * [@route] => /{{ROUTE}}
                 */
                public function {{FUNCNAME}}(){
                    echo "{{CLASSNAME}} Route created.";
                }
            
            }
            PHP;

            $baseControllerContent = str_replace("{{CLASSNAME}}", $name . "Controller", $baseControllerContent);
            $baseControllerContent = str_replace("{{FUNCNAME}}", strtolower($name), $baseControllerContent);
            $baseControllerContent = str_replace("{{ROUTE}}", strtolower($path), $baseControllerContent);


            IOFile::_open(
                IOTypeEnum::PHP,
                __DIR__ . "/../../../../../../../app/App/Controller/{$path}Controller.php"
            )->_write($baseControllerContent);

            echo CliColorEnum::FG_BRIGHT_GREEN->_paint("[MakeCommand:Controller] - Successfully created controller '{$name}'." . PHP_EOL);
            return true;
        } else if ($_prototype === "file"){
            return true;

        }  else if ($_prototype === "folder"){
            return true;
        }
        return false;
    }
}