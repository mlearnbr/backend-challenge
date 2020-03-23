<?php

namespace App\Api\MlearnApi;

class User {

    /**
     * ID do usuário no seu sistema. Poderá ser utilizado para buscar o usuário após sua criação.
     * @var string
     */
    public $external_id;

    /**
     * Número de celular do usuário no formato +5531999999999, será utilizado como login
     * @var string
     */

    public $msisdn;

    /**
     * Nome do usuário
     * @var string
     */
    public $name;

    /**
     * Nível de acesso do usuário: (free ou premium)
     * @var string
     */
    public $access_level;

    /**
     * Senha de acesso do usuário.
     * @var string
     */
    public $password;

    /**
     * ID do Mrlearn
     * @var string
     */
    public $mlearn_id;

    /**
     * @return string
     */
    public function getExternalId()
    {
        return $this->external_id;
    }

    /**
     * @param string $external_id
     * @return User
     */
    public function setExternalId($external_id)
    {
        $this->external_id = $external_id;
        return $this;
    }

    /**
     * @return string
     */
    public function getMsisdn()
    {
        return "+55{$this->msisdn}";
    }

    /**
     * Número de celular do usuário no formato +5531999999999, será utilizado como login
     * @param string $msisdn
     * @return User
     */
    public function setMsisdn($msisdn)
    {
        $this->msisdn = "+55{$msisdn}";
        return $this;
    }

    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param string $name
     * @return User
     */
    public function setName($name)
    {
        $this->name = $name;
        return $this;
    }

    /**
     * @return string
     */
    public function getAccessLevel()
    {
        return $this->access_level;
    }

    /**
     * @param string $access_level
     * @return User
     */
    public function setAccessLevel($access_level)
    {
        $this->access_level = $access_level;
        return $this;
    }

    /**
     * @return string
     */
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * @param string $password
     * @return User
     */
    public function setPassword($password)
    {
        $this->password = $password;
        return $this;
    }

    /**
     * @return string
     */
    public function getMlearnId()
    {
        return $this->mlearn_id;
    }

    /**
     * @param string $mlearn_id
     * @return User
     */
    public function setMlearnId($mlearn_id)
    {
        $this->mlearn_id = $mlearn_id;
        return $this;
    }

    /**
     * Parse to Json
     */
    public function toJson()
    {
        return json_encode($this->_prepareParse());
    }

    /**
     * Clear the obj before send
     */
    private function _prepareParse()
    {
        $aUser = (array) $this;
        $oUser = new \stdClass();
        foreach ($aUser as $field => $value){
            if(!empty($aUser[$field])){
                $oUser->$field = $value;
            }
        }

        return $oUser;
    }

}