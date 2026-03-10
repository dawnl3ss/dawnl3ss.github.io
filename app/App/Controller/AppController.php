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

namespace App\Controller;

use Aether\Http\Response\Format\HttpResponseFormatEnum;
use Aether\Http\ResponseFactory;
use Aether\IO\IOFile;
use Aether\IO\IOTypeEnum;
use Aether\Router\Controller\Controller;
use App\App;


class AppController extends Controller {

    /**
     * [@method] => GET
     * [@route] => /
     */
    public function home(){
        $this->_render("view/home.view", [
            "projects" => App::_load_projects()
        ]);
    }

    /**
     * [@method] => GET
     * [@route] => /writeups
     */
    public function writeups(){
        $count = 0;

        foreach(App::_load_writeups() as $platform => $wts){
            $count += count($wts);
        }

        $this->_render("view/writeups.view", [
            "writeups" => App::_load_writeups(),
            "realWuCount" => $count
        ]);
    }


    /**
     * [@method] => GET
     * [@route] => /resume/fr
     */
    public function cvfr(){

        $response = ResponseFactory::_create(
            HttpResponseFormatEnum::PDF,
            IOFile::_open(IOTypeEnum::OTHER, "public/files/cv-fr.pdf")->_read(),
            200
        );

        ob_clean();
        flush();

        $response->_send();
    }

    /**
     * [@method] => GET
     * [@route] => /resume/en
     */
    public function cven(){

        $response = ResponseFactory::_create(
            HttpResponseFormatEnum::PDF,
            IOFile::_open(IOTypeEnum::OTHER, "public/files/cv-en.pdf")->_read(),
            200
        );

        ob_clean();
        flush();

        $response->_send();
    }

}