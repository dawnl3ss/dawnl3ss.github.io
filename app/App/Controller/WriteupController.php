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

use Aether\Router\Controller\Controller;


class WriteupController extends Controller {

    /**
     * [@method] => GET
     * [@route] => /writeups/
     */
    public function writeup(){
        echo "WriteupController Route created.";
    }

    /**
     * [@method] => GET
     * [@route] => /writeups/hackthebox/{wt}
     */
    public function htb($wt){
        if (!in_array($wt, [ "boardlight", "headless", "legacy", "openadmin", "usage" ])){
            header("Location: /writeups");
            exit;
        }

        switch ($wt){
            case "boardlight":
                $this->_render("view/writeups/htb/boardlight.wt");
                break;
            case "headless":
                $this->_render("view/writeups/htb/headless.wt");
                break;
            case "legacy":
                $this->_render("view/writeups/htb/legacy.wt");
                break;
            case "openadmin":
                $this->_render("view/writeups/htb/openadmin.wt");
                break;
            case "usage":
                $this->_render("view/writeups/htb/usage.wt");
                break;
        }
    }

    /**
     * [@method] => GET
     * [@route] => /writeups/tryhackme/{wt}
     */
    public function thm($wt){
        if (!in_array($wt, [ "bounty-hacker", "cmess", "looking-glass", "wonderland", "simple-ctf" ])){
            header("Location: /writeups");
            exit;
        }

        switch ($wt){
            case "bounty-hacker":
                $this->_render("view/writeups/thm/bounty-hacker.wt");
                break;
            case "cmess":
                $this->_render("view/writeups/thm/cmess.wt");
                break;
            case "looking-glass":
                $this->_render("view/writeups/thm/looking-glass.wt");
                break;
            case "simple-ctf":
                $this->_render("view/writeups/thm/simple-ctf.wt");
                break;
            case "wonderland":
                $this->_render("view/writeups/thm/wonderland.wt");
                break;
        }
    }

}