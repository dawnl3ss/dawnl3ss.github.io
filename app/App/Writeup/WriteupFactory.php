<?php

namespace App\Writeup;

class WriteupFactory {


    public function __construct(){
        $this->_htbBoardlight();
    }

    public function _htbBoardlight(){
        return (new Writeup(
            _name: "Boardlight",
            _plateform: "HackTheBox",
            _link: "/writeups/hackthebox/boardlight",
            _difficulty: "Easy",
            _releaseDate: "06/10/2024",
            _thumb: "https://labs.hackthebox.com/storage/avatars/7768afed979c9abe917b0c20df49ceb8.png",
            _tags: ["ctf", "boot2root", "privesc", "web", "python"],
        ))->_addText("Caca");
    }
}