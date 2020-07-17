<!DOCTYPE html>
<html lang='ru'>
    <head>
        <script type="text/javascript" src = "https://code.jquery.com/jquery-3.5.1.js"></script>
        <meta charset='Windows-1251'>
        <title>jQuery</title>
        <link rel='stylesheet' href='../style.css' type='text/css'/>
    </head>
    <body>
        <input type="text" id="b" placeholder="id книги">
        <button id="submit" name="books" value = "1">Книги</button>
        <br />
        <div id="block"></div>
        <script>
            $(document).ready(function () {
                $("#submit").click(function () {
                    var fnumb = $("#b").val();
                    $.get("http://biblioteka.loc/api/books/"+ fnumb, {}, function (data) {

                        //data = $(data).find("#a1").html().replace ('&lt;br&gt;', "\r\n");
                        $("#block").html(data);

                    });
                });
            });
        </script>
    </body>
</html>

