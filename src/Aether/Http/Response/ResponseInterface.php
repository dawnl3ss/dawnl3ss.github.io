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
use Aether\Http\Response\Format\HttpResponseFormat;


interface ResponseInterface {

    /**
     * Get response's requested url.
     *
     * @return string
     */
    public function _getUrl() : string;

    /**
     * Get response's requested method.
     *
     * @return HttpMethod
     */
    public function _getMethod() : HttpMethod;

    /**
     * Return the provided format.
     *
     * @return HttpResponseFormat
     */
    public function _getFormat() : HttpResponseFormat;

    /**
     * Return response's body.
     *
     * @return string|array
     */
    public function _getBody() : string|array;

    /**
     * Return response's http status.
     *
     * @return int
     */
    public function _getStatus() : int;

    /**
     * Send the Response formatted body to server.
     *
     * @return void
     */
    public function _send() : void;

}