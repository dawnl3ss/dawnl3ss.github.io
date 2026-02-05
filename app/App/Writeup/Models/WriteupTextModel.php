<?php

namespace App\Writeup\Models;


class WriteupTextModel {


    /**
     * @param string $_text
     *
     * @return string
     */
    public function _render(string $_text){
        return "<p class='writeup-text'> {$_text} </p>";
    }
}