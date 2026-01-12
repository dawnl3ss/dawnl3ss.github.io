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

namespace Aether\Middleware\Stack;

use Aether\Api\Format\JsonResponse;
use Aether\Http\HttpParameterUnpacker;
use Aether\Middleware\MiddlewareInterface;
use Aether\Security\Token\CsrfToken;


final class CsrfMiddleware implements MiddlewareInterface {

    /**
     * @param callable $_next
     */
    public function _handle(callable $_next){

        # - We expose the token when http req is GET|HEAD|OPTIONS
        if (in_array($_SERVER['REQUEST_METHOD'], ['GET', 'HEAD', 'OPTIONS'])){
            CsrfToken::_exposeHeader();
            $_next();
            return;
        }

        # - Stricter verification when http req is POST|PUT|DELETE|PATCH
        $submitted = (new HttpParameterUnpacker())->_getAttribute("csrf_token")
            ?? $_SERVER['HTTP_X_CSRF_TOKEN']
            ?? '';

        if (!CsrfToken::_verify($submitted)){
            http_response_code(403);

            if (str_contains($_SERVER['HTTP_ACCEPT'] ?? '', 'application/json')){
                return (new JsonResponse())
                    ->_add('error', 'Invalid or missing CSRF token')
                    ->_add('code', 403)
                ->_encode();
            }

            echo '<h1>403 - Forbidden</h1><p>Invalid CSRF token.</p>';
            return;
        }

        $_next();
    }
}