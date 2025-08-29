<?php

class Project {

    /** @var string $route */
    private $route;

    /** @var string $name */
    private $name;

    /** @var string $description */
    private $description;

    /** @var string $url */
    private $url;

    /** @var string $icon */
    private $icon;

    public function __construct(string $route, string $name, string $description, string $url, string $icon){
        $this->route = $route;
        $this->name = $name;
        $this->description = $description;
        $this->url = $url;
        $this->icon = $icon;
    }

    /**
     * @return string
     */
    public function _get_route() : string { return $this->route; }

    /**
     * @return string
     */
    public function _get_name() : string { return $this->name; }

    /**
     * @return string
     */
    public function _get_description() : string { return $this->description; }

    /**
     * @return string
     */
    public function _get_url() : string { return $this->url; }

    /**
     * @return string
     */
    public function _get_icon() : string { return $this->icon; }
}