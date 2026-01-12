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

interface SessionInterface {


    /**
     * Return UserIntance if user is logged in (cf. Auth/), null if not.
     *
     * @return UserInstance|null
     */
    public function _getUser() : ?UserInstance;

    /**
     * Return SessionMetadata instance which contains all data related to the actual current session (id, related ips...)
     *
     * @return SessionMetadata
     */
    public function _getMetadata() : SessionMetadata;

    /**
     * Return SessionAppdata instance if the custom implemented App/ needs backend cache saving.
     *
     * @return SessionAppdata|null
     */
    public function _getAppdata() : ?SessionAppdata;

    /**
     *  Getter function that permits to instantiate the class easily
     *
     * @return SessionInstance
     */
    public static function _get() : SessionInstance;

}