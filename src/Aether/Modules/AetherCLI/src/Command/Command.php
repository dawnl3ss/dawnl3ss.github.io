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

use Aether\Modules\AetherCLI\Cli\CliLogger;

/**
 * Command pattern :
 *   ./aether {identifier}:?{prototype} ?[{data}]
 *
 * ex:
 *   ./aether help
 *   ./aether run
 *   ./aether make:controller Home
 *   ./aether make:controller Api/Auth/Login
 *
 *   ./aether source:db database.json
 *   ./aether source:script script.php
 *
 * ?{prototypes} should either be ["first"] or ["first", "second"] where the command is : ./aether first or ./aether first:second
 *
 * ?[{data}] should be an array of the extra data (eg. ./aether make:controller Home, it should be ["Home"]). Can be empty [].
 *
 */
abstract class Command extends CliLogger {

    /** @var string $_identifier */
    private string $_identifier;

    /** @var array $_prototypes */
    private array $_prototypes;

    /** @var array $_extra */
    private array $_extra;

    /** @var string $_signature */
    private string $_signature;


    public function __construct(string $_identifier, array $_prototypes, array $_extra, string $_signature){
        $this->_identifier = $_identifier;
        $this->_prototypes = $_prototypes;
        $this->_extra = $_extra;
        $this->_signature = $_signature;
    }

    /**
     * @return string
     */
    public function _getIdentifier() : string { return $this->_identifier; }

    /**
     * @return array
     */
    public function _getPrototypes() : array { return $this->_prototypes; }

    /**
     * @return array
     */
    public function _getExtra() : array { return $this->_extra; }

    /**
     * @return string
     */
    public function _getSignature() : string { return $this->_signature; }

    /**
     * @param ?string $_prototype
     *
     * @return bool
     */
    abstract public function _execute(?string $_prototype) : bool;
}