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

namespace Aether\Modules\AetherCLI;

use Aether\Modules\AetherCLI\Cli\CliArgParser;
use Aether\Modules\AetherCLI\Cli\CliColorEnum;
use Aether\Modules\AetherCLI\Cli\CliLogger;
use Aether\Modules\AetherCLI\Command\CommandDispatcher;
use Aether\Modules\AetherCLI\Command\List\MakeCommand;
use Aether\Modules\AetherCLI\Command\List\SourceCommand;
use Aether\Modules\AetherCLI\src\Command\List\SetupCommand;
use Aether\Modules\AetherModule;


final class Kernel extends AetherModule {

    /** @var CliLogger $_logger */
    private CliLogger $_logger;

    public function __construct(){
        parent::__construct("Aether-CLI", 1.0, "Permits you to use the full power of Aether-PHP core engine through cli and command files (eg. docker)");
        $this->_logger = new CliLogger();
    }



    public function _onLoad(){
        echo PHP_EOL . PHP_EOL . CliColorEnum::FG_BRIGHT_CYAN->_paint($this->_logger->_getAscii()) . PHP_EOL . PHP_EOL;

        echo CliColorEnum::FG_WHITE->_paint("✦ AetherCLI ready – divine command-line interface ☄️") . PHP_EOL;
        echo CliColorEnum::FG_WHITE->_paint("✦ Run ./bin/aether setup to initialize your project in seconds") . PHP_EOL . PHP_EOL;

        $args = CliArgParser::_parse();

        if (is_string($args))
            die($args . PHP_EOL);

        $extra = $args;
        unset($extra[0]);
        $extra = array_values($extra);

        # - Register all commands
        $registered = CommandDispatcher::_register([
            MakeCommand::class,
            SetupCommand::class,
            SourceCommand::class
        ], $extra);

        # - Dispatch all commands
        $cmdState = CommandDispatcher::_match($registered, $args);

        if (!$cmdState)
            die(CliColorEnum::FG_RED->_paint("[CommandDispatcher] - Error - Command did not succeed. Probably wrong usage.") .  PHP_EOL);
    }

    /**
     * @return AetherModule
     */
    public static function _make() : AetherModule {
        return new self();
    }

}