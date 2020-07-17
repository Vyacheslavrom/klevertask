<?php

class Pages {

    static public function beginPage($title) {
        echo"<!DOCTYPE html>\n";
        echo"<html lang='ru'>\n";
        echo"<head>\n";
        echo"<meta charset='Windows-1251'>\n";
        echo"<script type='text/javascript' src = 'https://code.jquery.com/jquery-3.5.1.js'></script>\n";
        echo"<title>$title</title>\n";
        echo"<link rel='stylesheet' href='style.css' type='text/css'/>";
        echo"</head>\n";
        echo"<body>\n";
        echo"<div class = 'login_text'>\n";
    }

    static public function endPage() {
        echo"</div>\n";
        echo"</body>\n";
        echo"</html>\n";
    }

}
