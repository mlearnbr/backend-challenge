<?php

namespace App\Models;

class Connection
{

    private $connection;
    private $host = DB_SERVER;
    private $user = DB_USER;
    private $pass = DB_PASS;
    private $db = DB_NAME;
    function __construct()
    {
        $this->open_connection();
    }

    private function open_connection()
    {

        $this->connection = mysqli_connect($this->host,$this->user,$this->pass, $this->db);

        if (!$this->connection) {
            return false;
        }else{
            return true;
        }
    }

    private function query($sql)
    {
        $result = mysqli_query($this->connection, $sql);
        $this->confirm_query($result);
        return $result;
    }

    public function multi_query($sql)
    {
        $result = mysqli_multi_query($this->connection, $sql);
        return $result;
    }
    private function confirm_query($result)
    {
        if(!$result){
            $output = "Erro na busca: " . mysqli_error($this->connection);

            die($output);
        }
    }

    private function fetch_array($result)
    {
        return mysqli_fetch_array($result);
    }
    private function fetch_object($result)
    {
        return mysqli_fetch_object($result);
    }
    private function mysqli_fetch_all($result)
    {
        return mysqli_fetch_all($result);
    }
    
    private function num_rows($result)
    {
        return mysqli_num_rows($result);
    }

    public function insert_id(){
        return mysqli_insert_id($this->connection);
    }

    
    public function rows($query){
        return $this->num_rows($this->query($query));
    }
    public function select($query){
        return $this->mysqli_fetch_all($this->query($query));
    }

    public function insert($query,$colums,$values){

        $dados = array_merge($colums,$values);
        for ($i=0; $i < count($dados) ; $i++) { 
            $query = str_replace("@".($i+1),$dados[$i],$query);
        }

        return $this->query($query);
    }
    public function update($query,$colums,$values){

        $dados = array_merge($colums,$values);
        for ($i=0; $i < count($dados) ; $i++) { 
            $query = str_replace("@".($i+1),$dados[$i],$query);
        }
        return $this->query($query);
    }
}
