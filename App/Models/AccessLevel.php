<?php

namespace App\Models;

class AccessLevel
{
    private $id;
    private $access_level;
    private $color;

    public function __construct($id = '', $access_level = '',$color = '')
    {
        $this->con = new Connection();
        $this->id = $id;
        $this->access_level = $access_level;
        $this->color = $color;
    }

    public function __set($name, $value)
    {
        $this->$name = $value;
    }
    public function __get($name)
    {
        return $this->$name;
    }

    public function salvar()
    {
        $query = "INSERT INTO access_level (@1)VALUES(@2);";
        if (!$this->checkExiste()) {
            return $this->con->insert($query, $this->getColums(), $this->toArray());
        } else {
            return false;
        }
    }
    public function fetchAll()
    {
        $query = "SELECT id, access_level,color FROM access_level;";
        $return = $this->con->select($query);
        $access_levels = array();
        foreach ($return as $value) {
            $access_level = new AccessLevel();
            $access_level->__set('id', $value[0]);
            $access_level->__set('access_level', $value[1]);
            $access_level->__set('color', $value[2]);
            $access_levels[] = $access_level;
        }
        return $access_levels;
    }

    private function checkExiste()
    {
        $query = "SELECT id FROM usuario WHERE msisdn = '" . $this->tel . "'";
        return $this->con->rows($query);
    }

    private function getColums()
    {
        return ['access_level'];
    }
    private function toArray()
    {
        return [$this->access_level];
    }
}
