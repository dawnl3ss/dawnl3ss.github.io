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


final class IOStream {

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
     * @return IOStream|null
     */
    public function _write(mixed $_content, bool $_append = false) : ?IOStream {
        $data = $this->_getParser()->_encode($_content);
        $mode = $_append ? 'ab' : 'wb';

        $fp = fopen($this->_path, $mode);
        if ($fp === false) return null;

        flock($fp, LOCK_EX);
        fwrite($fp, $data);
        flock($fp, LOCK_UN);
        fclose($fp);

        return $this;
    }

    /**
     * @param string $line
     * @param int|null $lineNumber
     *
     * @return IOStream|null
     */
    public function _writeLine(string $line, ?int $lineNumber = null) : ?IOStream {
        if (is_null($lineNumber))
            return $this->_write($line . PHP_EOL, true);

        $lines = file_exists($this->_path) ? $this->_readLines() : [];
        $lines[$lineNumber] = $line;

        return $this->_write(implode(PHP_EOL, $lines));
    }


    /**
     * @return string|null
     */
    public function _read() : ?string {
        if (!file_exists($this->_path))
            return null;

        $fp = fopen($this->_path, 'rb');
        if ($fp === false) return null;

        flock($fp, LOCK_SH);
        $content = stream_get_contents($fp);
        flock($fp, LOCK_UN);
        fclose($fp);

        return $content;
    }

    /**
     * @return array
     */
    public function _readLines() : array {
        if (!file_exists($this->_path))
            return [];

        $lines = [];
        $fp = fopen($this->_path, 'rb');

        if ($fp === false) return [];
        flock($fp, LOCK_SH);

        while (($line = fgets($fp)) !== false){
            $lines[] = rtrim($line, "\r\n");
        }
        flock($fp, LOCK_UN);
        fclose($fp);

        return $lines;
    }

    /**
     * Stream line by line with a callback (receives the current line and the line number (starting at 0))
     * If the callback returns false, reading stops early
     *
     * @param callable $callback fn(string $line, int $lineNumber): bool|null
     *
     * @return IOStream
     */
    public function _readEachLine(callable $callback) : IOStream {
        if (!file_exists($this->_path))
            return $this;

        $fp = fopen($this->_path, 'rb');
        if ($fp === false) return $this;

        flock($fp, LOCK_SH);

        $lineNumber = 0;
        while (($rawLine = fgets($fp)) !== false){
            $line = rtrim($rawLine, "\r\n");

            if ($callback($line, $lineNumber) === false)
                break;

            $lineNumber++;
        }

        flock($fp, LOCK_UN);
        fclose($fp);

        return $this;
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
     * @return IOStream
     */
    public static function _open(IOTypeEnum $_type, string $_path) : IOStream {
        return new self($_type, $_path);
    }

}