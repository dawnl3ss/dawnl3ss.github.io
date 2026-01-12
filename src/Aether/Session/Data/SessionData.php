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

namespace Aether\Session\Data;


abstract class SessionData implements SessionDataInterface {


    /** @var array $_raw */
    protected array $_raw = [];

    public function __construct(array $raw = null){
        if (is_array($raw))
            $this->_raw = $raw;
    }


    /**
     * @param string $key
     *
     * @return mixed
     */
    public function _get(string $key) : mixed {
        if ($this->_is($key))
            return $this->_raw[$key];

        return null;
    }

    /**
     * @param string $key
     * @param $value
     */
    public function _set(string $key, $value) : void {
        $this->_raw[$key] = $value;
    }

    /**
     * @param string $key
     *
     * @return bool
     */
    public function _is(string $key) : bool {
        return isset($this->_raw[$key]);
    }
}