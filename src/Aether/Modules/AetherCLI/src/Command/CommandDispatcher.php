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

namespace Aether\Modules\AetherCLI\Command;

use Aether\Modules\AetherCLI\Cli\CliColorEnum;


class CommandDispatcher {


    /**
     * Register array of commands
     *
     * @param array $_commands
     * @param array $_extra
     *
     * @return Command[]
     */
    public static function _register(array $_commands, array $_extra) : array {
        $cmds = [];

        foreach ($_commands as $command){
            $cmdInstance = new $command($_extra);

            if (!$cmdInstance instanceof Command)
                die(CliColorEnum::FG_RED->_paint("[CommandDispatcher] - Error - {$command} is not an instance of Command."));
            
            array_push($cmds, $cmdInstance);
        }

        return $cmds;
    }

    /**
     * @param Command[] $_commands
     *
     * @param array $_args
     *
     * @return bool
     */
    public static function _match(array $_commands, array $_args) : bool {
        $directives = explode(':', $_args[0]);
        $identifier = $directives[0];
        $prototype = $directives[1] ?? null;

        foreach ($_commands as $command){
            if ($identifier !== $command->_getIdentifier())
                continue;

            if (!is_null($prototype) && !in_array($prototype, $command->_getPrototypes()))
                continue;

            $command->_execute($prototype);
            return true;
        }
        return false;
    }
}