<?php

/*
 *
 *      █████╗ ███████╗████████╗██╗  ██╗███████╗██████╗         ██████╗ ██╗  ██╗██████╗
 *     ██╔══██╗██╔════╝╚══██╔══╝██║  ██║██╔════╝██╔══██╗        ██╔══██╗██║  ██║██╔══██╗
 *     ███████║█████╗     ██║   ███████║█████╗  ██████╔╝ █████╗ ██████╔╝███████║██████╔╝
 *     ██╔══██║██╔══╝     ██║   ██╔══██║██╔══╝  ██╔══██╗ ╚════╝ ██╔═══╝ ██╔══██║██╔═══╝
 *     ██║  ██║███████╗   ██║   ██║  ██║███████╗██║  ██║        ██║     ██║  ██║██║
 *     ╚═╝  ╚═╝╚══════╝   ╚═╝   ╚═╝  ╚═╝╚══════╝╚═╝  ╚═╝        ╚═╝     ╚═╝  ╚═╝╚═╝
 *
 *                      The divine lightweight PHP framework
 *                  < 1 Mo • Zero dependencies • Pure PHP 8.3+
 *
 *  Built from scratch. No bloat. POO Embedded.
 *
 *  @author: dawnl3ss (Alex') ©2025 — All rights reserved
 *  Source available • Commercial license required for redistribution
 *  → github.com/dawnl3ss/Aether-PHP
 *
*/
declare(strict_types=1);

namespace Aether\Session;


use Aether\Auth\User\UserInstance;
use Aether\Session\Data\SessionAppdata;
use Aether\Session\Data\SessionMetadata;

class SessionInstance implements SessionInterface {


    /** @var UserInstance|null $_user */
    private ?UserInstance $_user = null;

    /** @var SessionMetadata $_metadata */
    private SessionMetadata $_metadata;

    /** @var SessionAppdata|null $_appdata */
    private ?SessionAppdata $_appdata = null;

    /** @var array $_httpsess */
    private array $_httpsess;


    public function __construct(){
        $this->_httpsess = $_SESSION;

        $this->_setUser();
        $this->_setMetadata();
        $this->_setAppdata();
    }

    /**
     * @return array
     */
    public function _getHttpSess() : array { return $this->_httpsess; }

    /**
     * @return UserInstance|null
     */
    public function _getUser() : ?UserInstance { return $this->_user; }

    /**
     * @return SessionInstance
     */
    private function _setUser() : SessionInstance {
        if (isset($this->_httpsess["user"]))
            $this->_user = unserialize($this->_httpsess["user"]);

        return $this;
    }


    /**
     * @return SessionMetadata
     */
    public function _getMetadata() : SessionMetadata { return $this->_metadata; }

    /**
     * @return SessionInstance
     */
    private function _setMetadata() : SessionInstance {

        if (!isset($this->_httpsess["_metadata"])){
            $this->_metadata = new SessionMetadata();
            self::_addHttpSess("_metadata", serialize($this->_metadata));
        } else {
            $this->_metadata = unserialize($this->_httpsess["_metadata"]);
        }

        return $this;
    }

    /**
     * @return SessionAppdata|null
     */
    public function _getAppdata() : ?SessionAppdata{ return $this->_appdata; }

    /**
     * @return SessionInstance
     */
    private function _setAppdata() : SessionInstance {
        if (isset($this->_httpsess["app"]))
            $this->_appdata = unserialize($this->_httpsess["app"]);

        return $this;
    }


    /**
     * Add new data in HTTP $_SESSION superglobal.
     *
     * @param string $key
     * @param $value
     */
    public static function _addHttpSess(string $key, $value){
        # - Check if $value is an object and if yes we serialize it, we never know...
        # - permits free use of the func in the whole core while benefiting of a "centralized" datatype.
        if (is_object($value))
            $value = serialize($value);

        $_SESSION[$key] = $value;
    }


    /**
     * @return SessionInstance
     */
    public static function _get() : SessionInstance {
        return new self();
    }
}