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

    function __construct() {
        $this->mysqli = new mysqli("localhost", "newbook", "test", "newbook");
        if ($this->mysqli->connect_errno) {
            echo "Не удалось подключиться к MySQL: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error;
        }
    }

    function addAuthors($last, $first, $midl) {

        $query = "CALL addauthors('$last', '$first', '$midl')";
        if (!$this->mysqli->multi_query($query)) {
            return "Не удалось вызвать хранимую процедуру: (" . $this->mysqli->errno . ") " . $this->mysqli->error;
        }
        return "автор добавлен";
    }

    function uppAuthors($last, $first, $midl, $id) {

        $query = "CALL uppauthors('$last', '$first', '$midl', $id)";
        if (!$this->mysqli->multi_query($query)) {
            return "Не удалось вызвать хранимую процедуру: (" . $this->mysqli->errno . ") " . $this->mysqli->error;
        }
        return "данные автора обновлены";
    }

    function delAuthors($id) {

        $query = "CALL delauthors($id)";
        if (!$this->mysqli->multi_query($query)) {
            return "Не удалось вызвать хранимую процедуру: (" . $this->mysqli->errno . ") " . $this->mysqli->error;
        }
        return "автор удален";
    }

//$flag "id": "fam": "vse": "vseandbook":
    function getAuthors($id, $flag) {


        $query = "CALL getauthors('$id', '$flag')";

        if (!$this->mysqli->multi_query($query)) {
            echo "Не удалось вызвать хранимую процедуру: (" . $this->mysqli->errno . ") " . $this->mysqli->error;

            return $a = ["выбрать автора не удалось"];
        }

        do {
            if ($res = $this->mysqli->store_result()) {
                //print_r($res->fetch_all());
                //$res->free();
                $d = $res->fetch_all();
            } else {
                if ($this->mysqli->errno) {
                    echo "Не удалось получить результат на клиенте: (" . $this->mysqli->errno . ") " . $this->mysqli->error;
                }
            }
        } while ($this->mysqli->more_results() && $this->mysqli->next_result());

        return $d;
    }

    function igetAuthors($ff) {
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
                $bs .= "id: " . $row["ID"] . " - Name: " . $row["LastName"] . " " . $row["FirstName"] . " " . $row["MiddleName"] . " " .
                        "<a href = ?famil=$res >" . "КОЛ-ВО КНИГ У АВТОРА: " . count($this->objb->selBooks($row["ID"], "ida")) . "</a>" . "<br />";
            }
            return $bs;
        } else {
            return "0 results";
        }
//$this->mysqli->close();
    }

}
