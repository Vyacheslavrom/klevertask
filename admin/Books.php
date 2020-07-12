<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
  CREATE PROCEDURE uppauthors(last CHAR(50), first CHAR(50), midl CHAR(50))
  BEGIN
  UPDATE authors set LastName = last,  FirstName = first, MiddleName = midl
  WHERE `authors`.`ID` = id;
  END
 */
class Books {

    private $mysqli;

    function __construct($mysqli) {
        $this->mysqli = $mysqli;
    }

    function addBooks($name, $idauthor) {

        $query = "CALL addbooks('$name', '$idauthor')";
        if (!$this->mysqli->multi_query($query)) {
            echo "Не удалось вызвать хранимую процедуру: (" . !$this->mysqli->errno . ") " . !$this->mysqli->error;
        }
    }

    function uppBooks($name, $authorid, $id) {

        $query = "CALL uppbooks('$name', '$authorid', $id)";
        if (!$this->mysqli->multi_query($query)) {
            echo "Не удалось вызвать хранимую процедуру: (" . !$this->mysqli->errno . ") " . !$this->mysqli->error;
        }
    }

    function delBooks($id) {

        $query = "CALL delbooks($id)";
        if (!$this->mysqli->multi_query($query)) {
            echo "Не удалось вызвать хранимую процедуру: (" . !$this->mysqli->errno . ") " . !$this->mysqli->error;
        }
    }

    function selBooks($idAuthors) {

        $query = "CALL selbooks($idAuthors)";
        if (!$this->mysqli->multi_query($query)) {
            echo "Не удалось вызвать хранимую процедуру: (" . !$this->mysqli->errno . ") " . !$this->mysqli->error;
        }

        do {
            if ($res = $this->mysqli->store_result()) {
                //print_r($res->fetch_all());
                //$res->free();
                $d = $res->fetch_all();
                
            } else {
                if ($this->mysqli->errno) {
                    echo "Не удалось получить результат на клиенте: (" . !$this->mysqli->errno . ") " . !$this->mysqli->error;
                }
            }
        } while ($this->mysqli->more_results() && $this->mysqli->next_result());

        return $d;
    }

    function getBooks($ff) {
        if ($ff == '')
            $query = "SELECT ID, Name, author_id FROM books";
        else
            $query = "SELECT ID, Name, author_id FROM books where Name = '$ff'";
        if (!$this->mysqli->query($query)) {
            echo "Не удалось получить данные: (" . $this->mysqlierrno . ") " . $this->mysqlierror;
        } else
            $result = $this->mysqli->query($query);
        if ($result->num_rows > 0) {
            // output data of each row
            while ($row = $result->fetch_assoc()) {
                echo "id: " . $row["ID"] . " - Name: " . $row["Name"] . " ( " . "ida: " . $row["author_id"] . ") " . " " . "<br>";
            }
        } else {
            echo "0 results";
        }
//$this->mysqli->close();
    }

}
