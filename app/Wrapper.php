<?php

class Wrapper  {

    /** @var Project[] $projects */
    public static $projects;

    /** @var $writeups */
    public static $writeups;

    /**
     * @return Project[]
     */
    public static function _load_projects() : array {
        self::$projects = array(
            "websites" => [
                new Project(
                    "/hardware-hub", "Hardware Hub",
                    "Startup. We allow people to build their own PC configuration through our Config-Maker.",
                    "https://hardware-hub.fr/", "laptop"
                ),
                new Project(
                    "/lets-freerun", "Lets-Freerun",
                    "Website which gathers a lot of parkour spots around the world.",
                    "https://github.com/dawnl3ss/Lets-Freerun", "human"
                ),
            ],
            "tools" => [
                new Project(
                    "/kharon", "Kharon",
                    "Automated web-server CTF scanner which performs basic tasks of webserver pentesting.",
                    "https://github.com/dawnl3ss/Kharon", "skull"
                ),
                new Project(
                    "/theia", "Theia",
                    "IP-lookup OSINT tool for linux.",
                    "https://github.com/dawnl3ss/Theia", "search-web"
                ),
                new Project(
                    "/selene", "Selene",
                    "Database dumper written in Python3.",
                    "https://github.com/dawnl3ss/Selene", "database-export"
                ),
            ],
            "others" => [
                new Project(
                    "/ars-encrypt", "ARS-ENCRYPT",
                    "Modified Caesar's-cipher-based encrypt system written in C++.",
                    "https://github.com/dawnl3ss/ARS_ENCRYPT", "lock"
                ),
                new Project(
                    "/klephtes", "Klephtes",
                    "Grab and stock your website-viewers' data in a database written in PHP & SQL.",
                    "https://github.com/dawnl3ss/Klephtes", "account-key"
                ),
                new Project(
                    "/zephyr", "Zephyr",
                    "Web router written in PHP 7.4.",
                    "https://github.com/dawnl3ss/Zephyr", "directions"
                ),
            ],
        );

        return self::$projects;
    }
}