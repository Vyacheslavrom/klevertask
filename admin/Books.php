<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Books
 *
 * @author SL-r
 */

$mysqli = new mysqli("localhost", "newbook", "test", "newbook");
if ($mysqli->connect_errno) {
    echo "Не удалось подключиться к MySQL: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error;
}

class Books {
    private $mysqli;
    private $name;
    private $idAuthors;

    function __construct($mysqli) {
        $this->mysqli = $mysqli;
    }

    function addBooks($name, $idAuthors) {

        $query = "CALL addauthors('$name', '$idAuthors')";
        if (!$this->mysqli->multi_query($query)) {
            echo "Не удалось вызвать хранимую процедуру: (" . $mysqli->errno . ") " . $mysqli->error;
        }
    }

    function uppBooks($name, $idAuthors) {

        $query = "CALL uppauthors('$name', '$idAuthors')";
        if (!$this->mysqli->multi_query($query)) {
            echo "Не удалось вызвать хранимую процедуру: (" . $mysqli->errno . ") " . $mysqli->error;
        }
    }

    function delBooks($name) {

        $query = "CALL delauthors('$name')";
        if (!$this->mysqli->multi_query($query)) {
            echo "Не удалось вызвать хранимую процедуру: (" . $mysqli->errno . ") " . $mysqli->error;
        }
    }

    function selBooks($name) {

        $query = "CALL selauthors($name)";
        if (!$this->mysqli->multi_query($query)) {
            echo "Не удалось вызвать хранимую процедуру: (" . $mysqli->errno . ") " . $mysqli->error;
        }
        return $id;
    }

}