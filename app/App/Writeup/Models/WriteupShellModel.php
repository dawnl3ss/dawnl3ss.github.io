<?php

namespace App\Writeup\Models;

class WriteupShellModel {

    /**
     * @param string $_text
     *
     * @return string
     */
    public function _render(string $_text){
        return "
            <p class='writeup-text'>
                <code class='shell-response'>
$_text
                </code>
            </p>
        ";
    }
}