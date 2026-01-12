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

namespace Aether\Modules\AetherCLI\Cli;


enum CliColorEnum : string {

    case RESET = '0';

    case BOLD = '1';
    case DIM = '2';
    case UNDERLINE = '4';
    case BLINK = '5';
    case REVERSE = '7';
    case HIDDEN = '8';

    case FG_BLACK = '30';
    case FG_RED = '31';
    case FG_GREEN = '32';
    case FG_YELLOW = '33';
    case FG_BLUE = '34';
    case FG_MAGENTA = '35';
    case FG_CYAN = '36';
    case FG_WHITE = '37';

    case FG_BRIGHT_BLACK = '90';
    case FG_BRIGHT_RED = '91';
    case FG_BRIGHT_GREEN = '92';
    case FG_BRIGHT_YELLOW = '93';
    case FG_BRIGHT_BLUE = '94';
    case FG_BRIGHT_MAGENTA = '95';
    case FG_BRIGHT_CYAN = '96';
    case FG_BRIGHT_WHITE = '97';

    case BG_BLACK = '40';
    case BG_RED = '41';
    case BG_GREEN = '42';
    case BG_YELLOW = '43';
    case BG_BLUE = '44';
    case BG_MAGENTA = '45';
    case BG_CYAN = '46';
    case BG_WHITE = '47';

    case BG_BRIGHT_BLACK = '100';
    case BG_BRIGHT_RED = '101';
    case BG_BRIGHT_GREEN = '102';
    case BG_BRIGHT_YELLOW = '103';
    case BG_BRIGHT_BLUE = '104';
    case BG_BRIGHT_MAGENTA = '105';
    case BG_BRIGHT_CYAN = '106';
    case BG_BRIGHT_WHITE = '107';


    /**
     * Paint colored text through enum
     *
     * @param string $_text
     *
     * @return string
     */
    public function _paint(string $_text) : string {
        return "\e[{$this->value}m{$_text}\e[" . self::RESET->value . "m";
    }


    /**
     * Combine multiple colors
     *
     * @param CliColorEnum ...$_others
     *
     * @return string
     */
    public function _with(self ...$_others) : string {
        $codes = [$this->value, ...array_map(fn($c) => $c->value, $_others)];
        return "\e[" . implode(';', $codes) . "m";
    }

    /**
     * Return choosen enum's ansi code
     *
     * @return string
     */
    public function _code() : string { return "\e[{$this->value}m"; }
}