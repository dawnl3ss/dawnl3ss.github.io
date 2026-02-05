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
                    "The ultimate PC configurator for cost-optimized, verified and fully compatible setups.",
                    "https://hardware-hub.fr/", "laptop"
                ),
                new Project(
                    "/aether-php", "Aether-PHP",
                    "Framework - The divine lightweight PHP 8 framework. Secure, 0 dependency and no bloat.",
                    "https://github.com/Aether-PHP/Aether-PHP", "laptop"
                ),
            ],
            "web" => [
                new Project(
                    "/cochprodfr", "CochProd",
                    "Portfolio - Video Editing studio designed for growth.",
                    "https://cochprod.fr/", "laptop"
                ),
                new Project(
                    "/lets-freerun", "Lets-Freerun",
                    "Website - Platform dedicated to mapping and indexing parkour locations worldwide.",
                    "https://github.com/dawnl3ss/Lets-Freerun", "human"
                ),
                new Project(
                    "/zephyr", "Zephyr",
                    "HTTP - Fast and modern web router written in PHP 8.",
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
                    "Tool - Pentest and redteam tool designed to dump a whole database during missions.",
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
                    "https://github.com/dawnl3ss/AFIT", "square-root"
                ),
                new Project(
                    "/klephtes", "Klephtes",
                    "Website viewers' data logger written in PHP 8 & MySQL.",
                    "https://github.com/dawnl3ss/Klephtes", "account-key"
                )
            ],
        );
    }


    /**
     * @return array[]
     */
    public static function _load_writeups() : array {
        return array(
            "hackthebox" => [
                "openadmin" => [
                    "name" => "OpenAdmin",
                    "plateform" => "hackthebox",
                    "link" => "/writeups/hackthebox/openadmin",
                    "difficulty" => "easy",
                    "release_date" => "06/19/2024",
                    "thumb" => "https://labs.hackthebox.com/storage/avatars/5b00db157dbbd7099ff6c0ef10f910ea.png",
                    "tags" => ["ctf", "boot2root", "linux", "port forwarding", "apache2"]
                ],
                "legacy" => [
                    "name" => "Legacy",
                    "plateform" => "hackthebox",
                    "link" => "/writeups/hackthebox/legacy",
                    "difficulty" => "easy",
                    "release_date" => "06/16/2024",
                    "thumb" => "https://labs.hackthebox.com/storage/avatars/60dc190c4c015cfe3a3aef9b5afca254.png",
                    "tags" => ["ctf", "boot2root", "smb", "windows", "metasploit"]
                ],
                "boardlight" => [
                    "name" => "BoardLight",
                    "plateform" => "hackthebox",
                    "link" => "/writeups/hackthebox/boardlight",
                    "difficulty" => "easy",
                    "release_date" => "06/10/2024",
                    "thumb" => "https://labs.hackthebox.com/storage/avatars/7768afed979c9abe917b0c20df49ceb8.png",
                    "tags" => ["ctf", "boot2root", "privesc", "web", "python"]
                ],
                "usage" => [
                    "name" => "Usage",
                    "plateform" => "hackthebox",
                    "link" => "/writeups/hackthebox/usage",
                    "difficulty" => "easy",
                    "release_date" => "05/14/2024",
                    "thumb" => "https://labs.hackthebox.com/storage/avatars/23e804513a47e8f20bc865d0419946e1.png",
                    "tags" => ["ctf", "boot2root", "privesc", "web", "python"]
                ],
                "headless" => [
                    "name" => "Headless",
                    "plateform" => "hackthebox",
                    "link" => "/writeups/hackthebox/headless",
                    "difficulty" => "easy",
                    "release_date" => "04/30/2024",
                    "thumb" => "https://labs.hackthebox.com/storage/avatars/26e076db204a74b99390e586d7ebcf8c.png",
                    "tags" => ["ctf", "boot2root", "web", "command injection", "python", "xss"]
                ]
            ],
            "tryhackme" => [
                "cmess" => [
                    "name" => "CMesS",
                    "plateform" => "tryhackme",
                    "link" => "/writeups/tryhackme/cmess",
                    "difficulty" => "medium",
                    "release_date" => "07/13/2023",
                    "thumb" => "https://tryhackme-images.s3.amazonaws.com/room-icons/1516b0c85bb9f7312a88638df5b0f3af.png",
                    "tags" => ["security", "cms", "gila", "tar"]
                ],
                "looking-glass" => [
                    "name" => "Looking Glass",
                    "plateform" => "tryhackme",
                    "link" => "/writeups/tryhackme/looking-glass",
                    "difficulty" => "medium",
                    "release_date" => "06/11/2023",
                    "thumb" => "https://tryhackme-images.s3.amazonaws.com/room-icons/56215a135c08963843afda2240c317a3.png",
                    "tags" => ["wonderland", "ctf", "alice", "ssh"]
                ],
                "wonderland" => [
                    "name" => "Wonderland",
                    "plateform" => "tryhackme",
                    "link" => "/writeups/tryhackme/wonderland",
                    "difficulty" => "medium",
                    "release_date" => "06/04/2023",
                    "thumb" => "https://tryhackme-images.s3.amazonaws.com/room-icons/fdba6eaf85513262b2a9b12875b0f342.jpeg",
                    "tags" => ["wonderland", "ctf", "alice", "privesc"]
                ],
                "ignite" => [
                    "name" => "Ignite",
                    "plateform" => "tryhackme",
                    "link" => "/writeups/tryhackme/ignite",
                    "difficulty" => "easy",
                    "release_date" => "06/03/2023",
                    "thumb" => "https://tryhackme-images.s3.amazonaws.com/room-icons/676cb3273c613c9ba00688162efc0979.png",
                    "tags" => ["ctf", "boot2root", "privesc", "exploit"]
                ],
                "simple-ctf" => [
                    "name" => "Simple CTF",
                    "plateform" => "tryhackme",
                    "link" => "/writeups/tryhackme/simple-ctf",
                    "difficulty" => "easy",
                    "release_date" => "06/02/2023",
                    "thumb" => "https://tryhackme-images.s3.amazonaws.com/room-icons/f28ade2b51eb7aeeac91002d41f29c47.png",
                    "tags" => ["ctf", "security", "enumeration", "privesc"]
                ],
                "bounty-hacker" => [
                    "name" => "Bounty Hacker",
                    "plateform" => "tryhackme",
                    "link" => "/writeups/tryhackme/bounty-hacker",
                    "difficulty" => "easy",
                    "release_date" => "06/01/2023",
                    "thumb" => "https://tryhackme-images.s3.amazonaws.com/room-icons/9ad38a2cc31d6ae0030c888aca7fe646.jpeg",
                    "tags" => ["ctf", "linux", "easy", "privesc", "tar"]
                ]
            ]
        );
    }
}