<?php

namespace Source\Utils;

class Session
{

    public function __construct()
    {
        if (!session_id()) {
            session_start([
                "name" => "SYSTOQUE"
            ]);
        }
    }

    public function get($name)
    {
        return isset($_SESSION[$name]) ? $_SESSION[$name] : null;
    }

    public function set($name, $value)
    {
        return $_SESSION[$name] = $value;
    }

    public function has($name)
    {
        return isset($_SESSION[$name]);
    }

    public function remove($name)
    {
        unset($_SESSION[$name]);
    }
}
