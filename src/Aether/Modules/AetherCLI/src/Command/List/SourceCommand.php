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

namespace Aether\Modules\AetherCLI\Command\List;

use Aether\Modules\AetherCLI\Cli\CliColorEnum;
use Aether\Modules\AetherCLI\Command\Command;
use Aether\Modules\AetherCLI\Script\BaseScript;


class SourceCommand extends Command {

    public function __construct(array $_extra){
        parent::__construct(
            "source",
            [ "script", "db" ],
            $_extra,
            "./aether source:[script|db] {name}"
        );
    }

    public function _execute(?string $_prototype) : bool {
        if (is_null($_prototype))
            die(CliColorEnum::FG_RED->_paint("[SourceCommand] - Error - Missing prototype (script|db).") . PHP_EOL);

        if (count($this->_getExtra()) < 1)
            die(CliColorEnum::FG_RED->_paint("[SourceCommand] - Error - Missing source file.") . PHP_EOL);

        if ($_prototype === "script"){
            $script = $this->_getExtra()[0];

            if (!file_exists($script))
                die(CliColorEnum::FG_RED->_paint("[SourceCommand] - Error - Source file '{$script}' does not exists.") . PHP_EOL);

            if (strtolower(pathinfo($script, PATHINFO_EXTENSION)) !== 'php')
                die(CliColorEnum::FG_RED->_paint("[SourceCommand] - Error - Source file '{$script}' needs to be a php file.") . PHP_EOL);

            $script = new $script();

            if (!$script instanceof BaseScript)
                die($this->_echo("[SourceCommand] - Error - Provided script must be an instance of AetherCLI/Script/BaseScript.", CliColorEnum::FG_RED));

            $script->_onLoad();

            if (!$script->_onRun())
                die("[SourceCommand] - Error - _onRun() function contains error. You may fix it before running.");

            echo CliColorEnum::FG_BRIGHT_GREEN->_paint("[SourceCommand] - Successfully imported source file '{$script}'.") . PHP_EOL;
        } else if ($_prototype === "db"){

        }

        return true;
    }
}