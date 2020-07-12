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
class Authors {
    private $objb;
    private $mysqli;

    function __construct($mysqli, Books $objb) {
        $this->mysqli = $mysqli;
        $this->objb = $objb;
    }

    function addAuthors($last, $first, $midl) {

        $query = "CALL addauthors('$last', '$first', '$midl')";
        if (!$this->mysqli->multi_query($query)) {
            echo "Не удалось вызвать хранимую процедуру: (" . $this->mysqli->errno . ") " . $this->mysqli->error;
        }
    }

    function uppAuthors($last, $first, $midl, $id, $idbooks) {

        $query = "CALL uppauthors('$last', '$first', '$midl', $id, $idbooks)";
        if (!$this->mysqli->multi_query($query)) {
            echo "Не удалось вызвать хранимую процедуру: (" . $this->mysqli->errno . ") " . $this->mysqli->error;
        }
    }

    function delAuthors($id) {

        $query = "CALL delauthors($id)";
        if (!$this->mysqli->multi_query($query)) {
            echo "Не удалось вызвать хранимую процедуру: (" . $this->mysqli->errno . ") " . $this->mysqli->error;
        }
    }

    function selAuthors($id) {

        $query = "CALL selauthors($id)";
        if (!$this->mysqli->multi_query($query)) {
            echo "Не удалось вызвать хранимую процедуру: (" . $mysqli->errno . ") " . $mysqli->error;
         
            return $a = ["проблемка"];
        }

        do {
            if ($res = $this->mysqli->store_result()) {
                //print_r($res->fetch_all());
                //$res->free();
                $d = $res->fetch_all();
            } else {
                if ($this->mysqli->errno) {
                    echo "Не удалось получить результат на клиенте: (" . $mysqli->errno . ") " . $mysqli->error;
                }
            }
        } while ($this->mysqli->more_results() && $this->mysqli->next_result());

        return $d;
    }

    function getAuthors($ff) {
        if ($ff == '')
            $query = "SELECT LastName, FirstName, MiddleName, ID FROM authors";
        else
            $query = "SELECT LastName, FirstName, MiddleName, ID FROM authors where LastName = '$ff'";

        if (!$this->mysqli->query($query)) {
            echo "Нет такого автора: (" . $this->mysqlierrno . ") " . $this->mysqlierror;
        } else
            $result = $this->mysqli->query($query);
        if ($result->num_rows > 0) {
            // output data of each row
            while ($row = $result->fetch_assoc()) {
                $res = $row["ID"];
                echo "id: " . $row["ID"] . " - Name: " . $row["LastName"] . " " . $row["FirstName"] . " " . $row["MiddleName"] ." ". 
                        "<a href = ?author=$res >" . "КОЛ-ВО КНИГ У АВТОРА: "  . count($this->objb -> selBooks($row["ID"])) ."</a>" . "<br>";
            }
        } else {
            echo "0 results";
        }
//$this->mysqli->close();
    }

}
