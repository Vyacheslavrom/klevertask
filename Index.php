
<?php
include_once 'pages.php';
Pages::beginPage("Главная");
?>
<input type="text" id="b" placeholder="id книги">
<button id="submit" name="books" value = "1">Книги</button>
<br />

<script>
    $(document).ready(function () {
        $("#submit").click(function () {
            var fnumb = $("#b").val();
            $.get("http://biblioteka.loc/api/books/" + fnumb, {}, function (data) {

                //data = $(data).find("#a1").html().replace ('&lt;br&gt;', "\r\n");
                $("#block").html(JSON.parse(data).reduce(function (sum, current) {
                    return sum + ' ' + current.reduce(function (sum, current) {
                        return sum + ' ' + current;
                    }, '<br>');
                }, ));

            });
        });
    });
</script>
<input type="text" id="c" placeholder="id автора">
<button id="submit1" name="authors" value = "1">Авторы</button>
<br />
<script>
    $(document).ready(function () {
        $("#submit1").click(function () {
            var fnumb = $("#c").val();
            $.get("http://biblioteka.loc/api/authors/" + fnumb, {}, function (data) {

                //data = $(data).find("#a1").html().replace ('&lt;br&gt;', "\r\n");
                $("#block").html(JSON.parse(data).join('<br />'));

            });
        });
    });
</script>
<br /> 
<input type="text" id="name" placeholder="Название книги">        
<input type="text" id="ida" placeholder="id автора кторый ее написал">

<button id="submit2" name="addbooks" >Добавить книгу</button>
<br />
<script>
    $(document).ready(function () {
        $("#submit2").click(function () {
            var fname = $("#name").val();
            var fida = $("#ida").val();
            $.post("http://biblioteka.loc/api/books/", {name:fname, ida:fida}, function (data) {

                //data = $(data).find("#a1").html().replace ('&lt;br&gt;', "\r\n");
                $("#block").html(JSON.parse(data).join('<br />'));

            });
        });
    });
</script>
<div id="block"></div>
<? Pages::endPage(); ?>