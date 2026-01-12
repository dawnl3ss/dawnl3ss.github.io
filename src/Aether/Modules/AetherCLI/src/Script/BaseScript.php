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
 *  @author: dawnl3ss (Alex') ©2026 — All rights reserved
 *  Source available • Commercial license required for redistribution
 *  → github.com/dawnl3ss/Aether-PHP
 *
*/
declare(strict_types=1);

namespace Aether\Modules\AetherCLI\Script;

use Aether\Modules\AetherCLI\Cli\CliLogger;
use Aether\Modules\AetherCLI\src\Script\ScriptInterface;


/**
 * @class BaseScript : extends this class when you need to implement a AetherCLI script.
 */
abstract class BaseScript implements ScriptInterface {


    /** @var CliLogger $_logger */
    private CliLogger $_logger;

    /** @var string $_name */
    private string $_name;

    /** @var string $_purpose */
    private string $_purpose;


    public function __construct(string $_name, string $_purpose){
        $this->_logger = new CliLogger();
        $this->_name = $_name;
        $this->_purpose = $_purpose;
    }

    /**
     * @return CliLogger
     */
    public function _getLogger() : CliLogger { return $this->_logger; }

    /**
     * @return string
     */
    public function _getName() : string { return $this->_name; }

    /**
     * @return string
     */
    public function _getPurpose() : string { return $this->_purpose; }

    /**
     * @return void
     */
    abstract public function _onLoad() : void;

    /**
     * @return bool
     */
    abstract public function _onRun() : bool;
}