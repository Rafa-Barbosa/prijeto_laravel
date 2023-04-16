<?php

class db {
    private $_conn;

    function __construct() {
        $servername = "localhost";
        $username = "root";
        $password = "";
        $dbname = "projeto_laravel";
        
        $this->_conn = new mysqli($servername, $username, $password, $dbname);
        
        if ($this->_conn->connect_error) {
            echo 'Falha na conexão com banco: ' . $this->_conn->connect_error;
            die();
        }
    }

    public function query($sql) {
        $resultado = $this->_conn->query($sql);
        $num_rows = $resultado->num_rows ?? 0;

        if($resultado === TRUE) {
            $ret = $resultado;
        } else if($resultado->num_rows > 0) {
            $ret = [];
            while($row = $resultado->fetch_assoc()) {
                $ret[] = $row;
            }
        } else {
            $ret = "Error: " . $sql . "<br>" . $this->_conn->error;
        }

        return $ret;
    }
}