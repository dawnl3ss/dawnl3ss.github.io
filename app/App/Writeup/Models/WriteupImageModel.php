<?php

namespace App\Writeup\Models;

class WriteupImageModel {

    /**
     * @param string $_path
     *
     * @return string
     */
    public function _render(string $_path){
        return "
            <div>
                <img class='writeup-img' src='{$_path}'>
            </div>
        ";
    }
}