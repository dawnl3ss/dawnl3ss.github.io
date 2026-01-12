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

namespace Aether\View;


final class ViewInstance implements  ViewInterface {

    /** @var string $_path */
    private string $_path;

    /** @var array $_vars */
    private array $_vars;

    public function __construct(string $path, array $vars){
        $this->_path = $path;
        $this->_vars = $vars;
    }

    public function _render(){
        # - We extract and translate data from self::$_vars into php variables
        extract($this->_vars, EXTR_SKIP | EXTR_REFS);

        $fullpath = "public/" . $this->_path . ".php";

        if (!file_exists($fullpath))
            die("[View] - Error - Template not found : {$fullpath}");

        # - We turn output bufferin on and we include the given view page
        require_once $fullpath;
    }


    /**
     * @param string $path
     * @param array $vars
     */
    public static function _make(string $path, array $vars){
        (new self($path, $vars))->_render();
    }
}