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

namespace Aether\Modules;


abstract class AetherModule extends ModuleFactory implements ModuleInterface {

    /** @var string $_name */
    protected string $_name;

    /** @var float $_version */
    protected float $_version;

    /** @var string $_description */
    protected string $_description;


    public function __construct(string $_name, float $_version, string $_description){
        $this->_name = $_name;
        $this->_version = $_version;
        $this->_description = $_description;
    }

    /**
     * @return string
     */
    public function _getName() : string { return $this->_name; }

    /**
     * @return float
     */
    public function _getVersion() : float { return $this->_version; }

    /**
     * @return string
     */
    public function _getDescription() : string { return $this->_description; }


    /**
     * Function triggered on Aether Core loading
     */
    abstract public function _onLoad();


    /**
     * @return AetherModule
     */
    abstract public static function _make() : AetherModule;
}