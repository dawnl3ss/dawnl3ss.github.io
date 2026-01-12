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

namespace Aether\Modules\I18n\Lang;

use Aether\IO\IOFile;
use Aether\IO\IOTypeEnum;


final class LangHandler {

    /** @var array $_translations */
    private static array $_translations = [];

    /** @var string $_default */
    private static string $_default = "en";


    /**
     * @param string|null $_lang
     *
     * @return void
     */
    public static function _loadLangFile(?string $_lang = null) : void {
        $language = substr($_lang ?? ($_SERVER['HTTP_ACCEPT_LANGUAGE'] ?? self::$_default), 0, 2);

        self::$_translations = IOFile::_open(
            IOTypeEnum::JSON,
            __DIR__ . "/../../../../../../lang/" . $language . ".json"
        )->_readDecoded();
    }

    /**
     * @param string $_identifier
     * @param array|null $_params
     *
     * @return array|string|string[]
     */
    public static function _get(string $_identifier, ?array $_params = null) : mixed {
        $keys = explode('.', $_identifier);
        $value = self::$_translations;

        foreach ($keys as $k){
            $value = $value[$k] ?? $_identifier;
        }

        if (!is_string($value))
            return $_identifier;

        return empty($_params) ? $value : str_replace(
            array_keys($_params),
            array_values($_params),
            $value
        );
    }
}