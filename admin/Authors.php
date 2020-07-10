<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 BEGIN
UPDATE books set 'ast' = last, set 'first' = first, set 'midl' = midl  where id = id
END
 */
$mysqli = new mysqli("localhost", "newbook", "test", "newbook");
if ($mysqli->connect_errno) {
    echo "Не удалось подключиться к MySQL: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error;
}

class Authors {

    private $mysqli;
    private $last;
    private $first;
    private $midl;

    function __construct($mysqli) {
        $this->mysqli = $mysqli;
    }

    function addAuthors($last, $first, $midl) {

        $query = "CALL addauthors('$last', '$first', '$midl')";
        if (!$this->mysqli->multi_query($query)) {
            echo "Не удалось вызвать хранимую процедуру: (" . $mysqli->errno . ") " . $mysqli->error;
        }
    }

    function uppAuthors($last, $first, $midl) {

        $query = "CALL uppauthors('$last', '$first', '$midl')";
        if (!$this->mysqli->multi_query($query)) {
            echo "Не удалось вызвать хранимую процедуру: (" . $mysqli->errno . ") " . $mysqli->error;
        }
    }

    function delAuthors($last) {

        $query = "CALL delauthors('$last')";
        if (!$this->mysqli->multi_query($query)) {
            echo "Не удалось вызвать хранимую процедуру: (" . $mysqli->errno . ") " . $mysqli->error;
        }
    }

    function selAuthors($last) {

        $query = "CALL selauthors($last)";
        if (!$this->mysqli->multi_query($query)) {
            echo "Не удалось вызвать хранимую процедуру: (" . $mysqli->errno . ") " . $mysqli->error;
        }
        return $id;
    }

}

$authors = new Authors($mysqli);
$authors->addAuthors('Ромаов', 'Вячслав', 'Михайлович');
