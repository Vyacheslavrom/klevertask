<?php

class Pages {

    static public function beginPage($title) {
        echo"<!DOCTYPE html>\n";
        echo"<html lang='ru'>\n";
        echo"<head>\n";
        echo"<meta charset='Windows-1251'>\n";
        echo"<title>$title</title>\n";
        echo"<link rel='stylesheet' href='style.css' type='text/css'/>";
        echo"</head>\n";
        echo"<body>\n";
 
        echo"<div id = 'text'>";
    }

    static public function endPage() {
        echo"</div>";
        echo"</body>\n";
        echo"</html>\n";
    }

}
