<?php

namespace App\Writeup;

use App\Writeup\Models\WriteupImageModel;
use App\Writeup\Models\WriteupShellModel;
use App\Writeup\Models\WriteupTextModel;

class Writeup {

    /** @var string $_name */
    private string $_name;

    /** @var string $_plateform */
    private string $_plateform;

    /** @var string $_link */
    private string $_link;

    /** @var string $_difficulty */
    private string $_difficulty;

    /** @var string $_releaseDate */
    private string $_releaseDate;

    /** @var string $_thumb */
    private string $_thumb;

    /** @var string[] $_tags */
    private array $_tags;

    /** @var array $_content */
    private array $_content = [];


    public function __construct(string $_name,  string $_plateform, string $_link, string $_difficulty, string $_releaseDate, string $_thumb, array $_tags) {
        $this->_name = $_name;
        $this->_plateform = $_plateform;
        $this->_link = $_link;
        $this->_difficulty = $_difficulty;
        $this->_releaseDate = $_releaseDate;
        $this->_thumb = $_thumb;
        $this->_tags = $_tags;
    }

    /**
     * @return string
     */
    public function _getName() : string { return $this->_name; }

    /**
     * @return string
     */
    public function _getPlateform() : string { return $this->_plateform; }

    /**
     * @return string
     */
    public function _getLink() : string { return $this->_link; }

    /**
     * @return string
     */
    public function _getDifficulty() : string { return $this->_difficulty; }

    /**
     * @return string
     */
    public function _getReleaseDate() : string { return $this->_releaseDate; }

    /**
     * @return string
     */
    public function _getThumb() : string { return $this->_thumb; }

    /**
     * @return array|string[]
     */
    public function _getTags() : array { return $this->_tags; }

    /**
     * @return array
     */
    public function _getContent() : array { return $this->_content; }

    /**
     * @param string $_text
     *
     * @return Writeup
     */
    public function _addText(string $_text) : self {
        $this->_content[] = (new WriteupTextModel)->_render($_text);
        return $this;
    }

    /**
     * @param string $_text
     *
     * @return Writeup
     */
    public function _addShellResponse(string $_text) : self {
        $this->_content[] = (new WriteupShellModel)->_render($_text);
        return $this;
    }

    /**
     * @param string $_path
     *
     * @return Writeup
     */
    public function _addImage(string $_path) : self {
        $this->_content[] = (new WriteupImageModel)->_render($_path);
        return $this;
    }
}