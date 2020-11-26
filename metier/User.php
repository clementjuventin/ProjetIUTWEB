<?php


class User
{
    private $login;

    /**
     * User constructor.
     */
    public function __construct()
    {
        $this->login = 'public';
    }


    /**
     * @return mixed
     */
    public function getLogin()
    {
        return $this->login;
    }

    /**
     * @param mixed $login
     */
    public function setLogin($login)
    {
        $this->login = $login;
    }

    public function __toString()
    {
        return $this->getLogin();
    }
}