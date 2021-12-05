<?php

namespace App\Models;

class Usuario
{
    private $id;
    private $id_mlearn;
    private $nome;
    private $tel;
    private $level;
    private $password;
    private $con;

    public function __construct($id = '', $nome = '', $tel = '', $level = '', $password = '')
    {
        $this->con = new Connection();
        $this->id = $id;
        $this->nome = $nome;
        $this->tel = $tel;
        $this->level = $level;
        $this->password = $password;
    }

    public function __set($name, $value)
    {
        $this->$name = $value;
    }
    public function __get($name)
    {
        return $this->$name;
    }

    public function salvarIdMLearn()
    {
        $colum = ["id_mlearn = '$this->id_mlearn'"];
        $where = ["id = $this->id"];
        $query = "UPDATE usuario SET @1 WHERE @2 ";
        return $this->con->update($query,  $colum, $where);
    }
    public function novoLevel($id)
    {
        if ($this->id_mlearn) {
            $interacao = new Integracao();
            if ($this->level < $id) {
                $tipo = "upgrade";
            } else {
                $tipo = "downgrade";
            }
            $interacao->upgradeMLeran($this->id_mlearn, $tipo);
        }
        $colum = ["access_level = $id"];
        $where = ["id = $this->id"];
        $query = "UPDATE usuario SET @1 WHERE @2 ";
        return $this->con->update($query,  $colum, $where);
    }
    public function salvar()
    {
        $query = "INSERT INTO usuario (@1,@2,@3,@4)VALUES(@5,@6,@7,@8);";
        if (!$this->checkExiste()) {
            $retorno = $this->con->insert($query, $this->getColums(), $this->toArray());
            $id = $this->con->insert_id();
            $usuario = new Usuario($id);
            $usuario->fetch();

            $dados = [
                "msisdn" => $usuario->__get('tel'),
                "name" => $usuario->__get('nome'),
                "access_level" => strtolower($usuario->__get('level')),
                "external_id" => $usuario->__get('id')
            ];

            $interacao = new Integracao();

            $retorno_integracao = $interacao->cadastroMLeran(json_encode($dados));
            if (is_object($retorno_integracao)) {

                $id_mlearn = $retorno_integracao->resposta->data->id;
                $usuario->__set('id_mlearn', $id_mlearn);
                $usuario->salvarIdMLearn();
            }
            return $retorno;
        } else {
            return false;
        }
    }
    public function fetch()
    {
        $query = "SELECT u.id,u.name,u.msisdn,a.access_level FROM usuario u JOIN access_level a ON u.access_level = a.id WHERE u.id = $this->id;";
        $return = $this->con->select($query);
        foreach ($return as $value) {
            $this->id = $value[0];
            $this->nome = $value[1];
            $this->tel = $value[2];
            $this->level = $value[3];
        }
    }
    public function fetchAll()
    {
        $query = "SELECT u.id,u.name,u.msisdn,a.access_level FROM usuario u JOIN access_level a ON u.access_level = a.id;";
        $return = $this->con->select($query);
        $usuarios = array();
        foreach ($return as $value) {
            $usuario = new Usuario();
            $usuario->__set('id', $value[0]);
            $usuario->__set('nome', $value[1]);
            $usuario->__set('tel', $value[2]);
            $usuario->__set('level', $value[3]);
            $usuarios[] = $usuario;
        }
        return $usuarios;
    }

    private function checkExiste()
    {
        $query = "SELECT id FROM usuario WHERE msisdn = '" . $this->tel . "'";
        return $this->con->rows($query);
    }

    private function getColums()
    {
        return ['name', 'msisdn', 'access_level', 'password'];
    }
    private function toArray()
    {
        return ["'$this->nome'", "'$this->tel'", $this->level, "'$this->password'"];
    }
}
