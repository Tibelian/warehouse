<?php

/**
 * @author TID 2ºDAW
 */

class Session{

    private static $user;
    private static $loggedIn;

    ////////////
    // GETTER //
    ////////////
    public function getUser(){
        return self::$user;
    }
    public function getLoggedIn(){
        return self::$loggedIn;
    }

    ////////////
    // SETTER //
    ////////////
    public function setUser(User $user){
        self::$user = $user;
    }
    public function setLoggedIn($loggedIn){
        self::$loggedIn = $loggedIn;
    }

    public function reload(){
        if(isset($_SESSION['user']) && $_SESSION['user'] instanceof User){
            self::setUser($_SESSION['user']);
            self::setLoggedIn(true);
        }
    }


}