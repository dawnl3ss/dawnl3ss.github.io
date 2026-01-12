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

namespace Aether\IO\Parser;


final class EnvParser implements ParserInterface {

    /**
     * @param mixed $_data
     *
     * @return string
     */
    public function _encode(mixed $_data) : string {
        if (!is_array($_data))
            return '';

        $lines = [];

        foreach ($_data as $key => $value){
            $value = is_array($value) ? json_encode($value) : $value;
            $lines[] = $key . '=' . $value;
        }
        return implode(PHP_EOL, $lines) . PHP_EOL;
    }


    /**
     * @param string $_content
     *
     * @return mixed
     */
    public function _decode(string $_content) : mixed {
        $lines = array_filter(array_map('trim', explode(PHP_EOL, $_content)));
        $env = [];

        foreach ($lines as $line){
            if (str_contains($line, '=')){
                [$key, $value] = explode('=', $line, 2);
                $env[trim($key)] = trim($value, '"\'');
            }
        }
        return $env;
    }
}