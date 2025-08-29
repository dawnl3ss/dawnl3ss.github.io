<?php

class Writeup {

    /** @var string $route */
    private $route;

    /** @var string $title */
    private $title;

    /** @var string $platform */
    private $platform;

    /** @var Struct[] $content */
    private $content;

    /** @var string $date */
    private $date;

    /** @var string[] $tags */
    private $tags;

    public function __construct(string $route, string $title, string $platform, array $content, string $date, array $tags){
        $this->route = $route;
        $this->title = $title;
        $this->platform = $platform;
        $this->content = $content;
        $this->date = $date;
        $this->tags = $tags;
    }

    /**
     * @return string
     */
    public function _get_route(){ return $this->route; }

    /**
     * @return string
     */
    public function _get_title(){ return $this->title; }

    /**
     * @return string
     */
    public function _get_platform(){ return $this->platform; }

    /**
     * @return string
     */
    public function _get_date(){ return $this->date; }

    /**
     * @return string[]
     */
    public function _get_tags(){ return $this->tags; }


    /**
     * @param Struct $content
     *
     * @return self
     */
    private function _add_content(Struct $content) : self {
        array_push($this->content, $content);
        return $this;
    }

    /**
     * @param string $text
     *
     * @return self
     */
    public function _add_text(string $text) : self {
        return $this->_add_content(
            new WriteupText()
        );
    }

    /**
     * @param string $text
     *
     * @return self
     */
    public function _add_image(string $src) : self {
        return $this->_add_content(
            new WriteupImage()
        );
    }

    /**
     * @param string $text
     *
     * @return self
     */
    public function _add_shell(string $response) : self {
        return $this->_add_content(
            new WriteupShell()
        );
    }

    /**
     * @return Struct[]
     */
    public function _get_content(){ return $this->content; }
}