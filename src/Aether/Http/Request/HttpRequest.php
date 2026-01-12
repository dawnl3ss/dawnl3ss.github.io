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

namespace Aether\Http\Request;

use Aether\Http\Methods\HttpMethod;
use Aether\Http\Methods\HttpMethodEnum;
use Aether\Http\Response\HttpResponse;


class HttpRequest implements RequestInterface {

    /** @var string $_destination */
    private string $_destination;

    /** @var HttpMethod $_method */
    private HttpMethod $_method;

    /** @var resource|null $_curl */
    private mixed $_curl = null;


    public function  __construct(string $_destination, HttpMethod $_method){
        $this->_destination = $_destination;
        $this->_method = $_method;
        $this->_init();
    }

    private function _init() : void {
        $this->_curl = curl_init();

        curl_setopt_array($this->_curl, [
            CURLOPT_URL => $this->_destination,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_HEADER => true,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_TIMEOUT => 10,
        ]);

        match ($this->_getMethod()->_getName()){
            HttpMethodEnum::GET->value => curl_setopt($this->_curl, CURLOPT_HTTPGET, true),
            HttpMethodEnum::POST->value => curl_setopt($this->_curl, CURLOPT_POST, true),
            HttpMethodEnum::PUT->value,
            HttpMethodEnum::DELETE->value => curl_setopt($this->_curl, CURLOPT_CUSTOMREQUEST, $this->_getMethod()->_getName()),
        };
    }

    /**
     * @return string
     */
    public function _getDestination() : string { return $this->_destination; }

    /**
     * @return HttpMethod
     */
    public function _getMethod() : HttpMethod { return $this->_method; }

    /**
     * @return HttpResponse|null
     */
    public function _send() : ?HttpResponse {
        if (!$this->_curl)
            return null;

        $response = curl_exec($this->_curl);

        if (!$response){
            curl_close($this->_curl);
            return null;
        }

        $code = curl_getinfo($this->_curl, CURLINFO_HTTP_CODE);
        $hSize = curl_getinfo($this->_curl, CURLINFO_HEADER_SIZE);

        $headers = substr($response, 0, $hSize);
        $body = substr($response, $hSize);

        curl_close($this->_curl);

        return null;
    }
}