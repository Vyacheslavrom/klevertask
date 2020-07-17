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
    private $obja;

    function __construct() {
        
        $this->mysqli = new mysqli("localhost", "newbook", "test", "newbook");
        if ($this->mysqli->connect_errno) {
            echo "Не удалось подключиться к MySQL: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error;
        }
    }

    function addBooks($name, $idauthor) {

        $query = "CALL addbooks('$name', '$idauthor')";
        if (!$this->mysqli->multi_query($query)) {
            return "Не удалось вызвать хранимую процедуру: (" . !$this->mysqli->errno . ") " . !$this->mysqli->error;
        }
        return "книга добавлена";
    }

    function uppBooks($name, $authorid, $id) {

        $query = "CALL uppbooks('$name', '$authorid', $id)";
        if (!$this->mysqli->multi_query($query)) {
            return "Не удалось вызвать хранимую процедуру: (" . !$this->mysqli->errno . ") " . !$this->mysqli->error;
        }
        return "данные книги обновлены";
    }

    function delBooks($id) {

        $query = "CALL delbooks($id)";
        if (!$this->mysqli->multi_query($query)) {
            return "Не удалось вызвать хранимую процедуру: (" . !$this->mysqli->errno . ") " . !$this->mysqli->error;
        }
        return "книга удалена";
    }

//$flag "id": "ida": "nameb": "vse": 
    function getBooks($idname, $flag) {

        $query = "CALL getbooks('$idname', '$flag')";


        if (!$this->mysqli->multi_query($query)) {
            echo "Не удалось вызвать хранимую процедуру: (" . !$this->mysqli->errno . ") " . !$this->mysqli->error;

            return $a = ["выбрать книгу не удалось"];
        }

        do {
            if ($res = $this->mysqli->store_result()) {
                //print_r($res->fetch_all());
                //$res->free();
                $d = $res->fetch_all();
            } else {
                if ($this->mysqli->errno) {
                    return "Не удалось получить результат на клиенте: (" . !$this->mysqli->errno . ") " . !$this->mysqli->error;
                }
            }
        } while ($this->mysqli->more_results() && $this->mysqli->next_result());
        return $d;
    }

    function igetBooks($ff, Authors $obja) {
        $this->obja = $obja;
        if ($ff == '')
            $query = "SELECT ID, Name, author_id FROM books";
        else
            $query = "SELECT ID, Name, author_id FROM books where Name = '$ff'";
        if (!$this->mysqli->query($query)) {
            return "Не удалось получить данные: (" . $this->mysqlierrno . ") " . $this->mysqlierror;
        } else
            $result = $this->mysqli->query($query);
        if ($result->num_rows > 0) {
            // output data of each row
            while ($row = $result->fetch_assoc()) {
                $arr1 = $this->obja->selAuthors($row["author_id"]);
                foreach ($arr1[0] as $v1) {
                    $aut = $aut . " " . $v1;
                }
                $ress .= "id: " . $row["ID"] . " - Name: " . $row["Name"] . " ( " . " автор: " . $aut . ") " . " " . "<br/>";
                $aut = "";
            }
            return $ress;
        } else {
            return "0 results";
        }
//$this->mysqli->close();
    }

}
