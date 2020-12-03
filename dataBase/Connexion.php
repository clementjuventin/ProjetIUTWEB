<?php

class Connexion extends PDO
{
    private $stmt;

    public function __construct($dsn, $username, $passwd)
    {
        parent::__construct($dsn, $username, $passwd);
        $this->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
    }

    public function executeQuery($query, $parameters = []):bool{
        $this->stmt = parent::prepare($query);
        foreach ($parameters as $name => $value) {
            $this->stmt->bindValue($name, $value[0], $value[1]);
        }
        return $this->stmt->execute();
    }

    public function getResults(){
        return $this->stmt->fetchall();
    }
    public function getSucceed():bool{
        if($this->stmt->rowCount()==1){
            return true;
        }
        return false;
    }
}