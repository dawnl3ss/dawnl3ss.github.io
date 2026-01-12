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

namespace Aether\IO;

use Aether\IO\Parser\EnvParser;
use Aether\IO\Parser\JsonParser;
use Aether\IO\Parser\ParserInterface;


final class IOFile {

    /** @var IOTypeEnum $_type */
    private IOTypeEnum $_type;

    /** @var string $_path */
    private string $_path;


    public function __construct(IOTypeEnum $_type, string $_path){
        $this->_type = $_type;
        $this->_path = $_path;
    }

    /**
     * @return ParserInterface
     */
    private function _getParser() : ParserInterface {
        return match ($this->_type){
            IOTypeEnum::JSON => new JsonParser(),
            IOTypeEnum::ENV => new EnvParser(),

            default => new class implements ParserInterface {
                public function _encode(mixed $_data) : string { return is_string($_data) ? $_data : var_export($_data, true); }
                public function _decode(string $_content) : string { return $_content; }
            },
        };
    }

    /**
     * @param mixed $_content
     * @param bool $_append
     *
     * @return IOFile|null
     */
    public function _write(mixed $_content, bool $_append = false) : ?IOFile {
        $data = $this->_getParser()->_encode($_content);
        $flags = $_append ? FILE_APPEND | LOCK_EX : LOCK_EX;

        if (!file_put_contents($this->_path, $data, $flags))
            return null;

        return $this;
    }

    /**
     * @param string $line
     * @param int|null $lineNumber
     *
     * @return IOFile|null
     */
    public function _writeLine(string $line, ?int $lineNumber = null) : ?IOFile {
        if (is_null($lineNumber))
            return $this->_write($line . PHP_EOL, true);

        $lines = file_exists($this->_path) ? explode(PHP_EOL, $this->_read()) : [];
        $lines[$lineNumber] = $line;
        return $this->_write(implode(PHP_EOL, $lines));
    }


    /**
     * @return string|null
     */
    public function _read() : ?string {
        if (!file_exists($this->_path))
            return null;

        return file_get_contents($this->_path);
    }

    /**
     * @return array
     */
    public function _readLines() : array {
        return file_exists($this->_path) ? file($this->_path, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES) : [];
    }

    /**
     * @return mixed
     */
    public function _readDecoded() : mixed {
        $content = $this->_read();

        if (is_null($content))
            return null;

        return $this->_getParser()->_decode($content);
    }

    /**
     * @return bool
     */
    public function _delete() : bool {
        return file_exists($this->_path) && unlink($this->_path);
    }

    /**
     * @param IOTypeEnum $_type
     * @param string $_path
     *
     * @return IOFile
     */
    public static function _open(IOTypeEnum $_type, string $_path) : IOFile {
        return new self($_type, $_path);
    }

}