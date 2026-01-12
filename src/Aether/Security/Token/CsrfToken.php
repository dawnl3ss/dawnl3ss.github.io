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
 *  → https://github.com/dawnl3ss/Aether-PHP
 *
*/
declare(strict_types=1);

namespace Aether\Security\Token;


final class CsrfToken {

    /** @var string KEY */
    private const KEY = 'csrf_token';

    /**
     * @return string
     */
    public static function _generate() : string {
        $token = bin2hex(random_bytes(32));
        $_SESSION[self::KEY] = $token;
        return $token;
    }

    /**
     * @return string
     */
    public static function _get() : string {
        if (!isset($_SESSION[self::KEY]))
            return self::_generate();

        return $_SESSION[self::KEY];
    }

    /**
     * @param string $_submitted
     *
     * @return bool
     */
    public static function _verify(string $_submitted) : bool {
        if (!isset($_SESSION[self::KEY]))
            return false;

        $valid = hash_equals($_SESSION[self::KEY], $_submitted);

        # - Anti replay : the goal here is to regenerate the csrf token to avoid potential token replaying
        if ($valid)
            self::_generate();

        return $valid;
    }

    /**
     * @return null
     */
    public static function _exposeHeader() { return header('X-CSRF-Token: ' . self::_get()); }

}