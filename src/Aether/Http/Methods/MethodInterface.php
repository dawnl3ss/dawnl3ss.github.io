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

namespace Aether\Http\Methods;


interface MethodInterface {


    /**
     * Get HTTP method's name.
     *
     * @return string
     */
    public function _getName() : string;

    /**
     * Pure application of RFC 9110.
     * -> Safe methods must not alter server state.
     *
     * @return bool
     */
    public function _isSafe() : bool;


    /**
     * Return whether the method can hypothetically be cached.
     * -> Yes for GET, HEAD.
     *
     * @return bool
     */
    public function _isCacheable() : bool;

    /**
     * Return whether the method can ACCEPT a body.
     * -> Yes for POST, PUT, PATCH.
     *
     * @return bool
     */
    public function _allowsBody() : bool;

    /**
     * Return wether the method NEED a body.
     * -> Yes for POST, PUT, PATCH.
     * -> Method used for stricter checks.
     *
     * @return bool
     */
    public function _requiresBody() : bool;
}