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
 *  Built from scratch. No bloat. OOP Embedded.
 *
 *  @author: dawnl3ss (Alex') ©2026 — All rights reserved
 *  Source available • Commercial license required for redistribution
 *  → github.com/dawnl3ss/Aether-PHP
 *
*/
declare(strict_types=1);

namespace Aether\Http\Response;

use Aether\Http\Methods\HttpMethod;
use Aether\Http\Methods\HttpMethodEnum;
use Aether\Http\Response\Format\HttpResponseFormat;
use Aether\Http\Response\Format\HttpResponseFormatEnum;

class HttpResponse implements ResponseInterface {

    /** @var string $_url */
    private string $_url;

    /** @var HttpMethod $_method */
    private HttpMethod $_method;

    /** @var string|array $_body */
    private string|array $_body;

    /** @var int $_statusCode */
    private int $_statusCode;

    /** @var HttpResponseFormat $_format */
    private HttpResponseFormat $_format;


    public function __construct(HttpResponseFormatEnum $_format, string|array $_body, int $_statusCode, string $_url, HttpMethodEnum $_method){
        $this->_url = $_url;
        $this->_method = $_method->_make();
        $this->_body = $_body;
        $this->_format = $_format->_make();
        $this->_statusCode = $_statusCode;
    }

    /**
     * @return string
     */
    public function _getUrl() : string { return $this->_url; }

    /**
     * @return HttpMethod
     */
    public function _getMethod() : HttpMethod { return $this->_method; }

    /**
     * @return string|array
     */
    public function _getBody() : string|array { return $this->_body; }

    /**
     * @return HttpResponseFormat
     */
    public function _getFormat() : HttpResponseFormat { return $this->_format; }

    /**
     * @return int
     */
    public function _getStatus() : int { return $this->_statusCode; }

    /**
     * @return void
     */
    public function _send() : void {
        header($this->_getFormat()->_getHeader());
        $body = $this->_getBody();

        if ($this->_getFormat()->_getName() === HttpResponseFormatEnum::JSON->value)
            $body = json_encode($body);

        echo $body;
        exit;
    }
}