<?php

namespace App;

use App\Project\Project;

class App {

    /**
     * @return Project[]
     */
    public static function _load_projects() : array {
        return array(
            "main" => [
                new Project(
                    "/hardware-hub", "Hardware Hub",
                    "SaaS - Best PC configurator available. Permits users to create the fitted PC Config.",
                    "https://hardware-hub.fr/", "laptop"
                ),
                new Project(
                    "/aether-php", "Aether-PHP",
                    "Framework - The divine lightweight PHP 8 framework. Secure, 0 dependency and no bloat.",
                    "https://github.com/dawnl3ss/Aether-PHP", "laptop"
                ),
            ],
            "web" => [
                new Project(
                    "/cochprodfr", "CochProd",
                    "Portfolio - desc...",
                    "https://hardware-hub.fr/", "laptop"
                ),
                new Project(
                    "/lets-freerun", "Lets-Freerun",
                    "Website which gathers a lot of parkour spots around the world.",
                    "https://github.com/dawnl3ss/Lets-Freerun", "human"
                ),
                new Project(
                    "/zephyr", "Zephyr",
                    "HTTP Router - Web router written in PHP 8.",
                    "https://github.com/dawnl3ss/Zephyr", "directions"
                ),
            ],
            "cybersecurity" => [
                new Project(
                    "/kharon", "Kharon",
                    "Tool - Automated web-server CTF scanner which performs basic tasks of webserver pentesting.",
                    "https://github.com/dawnl3ss/Kharon", "skull"
                ),
                new Project(
                    "/theia", "Theia",
                    "Tool - IP-lookup OSINT tool for linux.",
                    "https://github.com/dawnl3ss/Theia", "search-web"
                ),
                new Project(
                    "/selene", "Selene",
                    "Tool - Database dumper written in Python3.",
                    "https://github.com/dawnl3ss/Selene", "database-export"
                ),
            ],
            "misc" => [
                new Project(
                    "/ars-encrypt", "ARS-ENCRYPT",
                    "Modified Caesar's-cipher-based encrypt system written in C++.",
                    "https://github.com/dawnl3ss/ARS_ENCRYPT", "lock"
                ),
                new Project(
                    "/afit", "Arithmetic-for-IT",
                    "Aimed  to build first standard ciphering algorithms (RSA & ElGamal cryptosystems).",
                    "https://github.com/dawnl3ss/ARS_ENCRYPT", "square-root"
                ),
                new Project(
                    "/klephtes", "Klephtes",
                    "Grab and stock your website-viewers' data in a database written in PHP & SQL.",
                    "https://github.com/dawnl3ss/Klephtes", "account-key"
                )
            ],
        );
    }
}