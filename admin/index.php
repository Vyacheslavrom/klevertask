<?php
include "../pages.php";
Pages::beginPage("Админская страничка");
?>
<input type="text" id="c" placeholder="id автора">
<button id="submit1" name="authors" value = "1">Авторы</button>
<br /><br />
<input type="text" id="b" placeholder="id книги">
<button id="submit" name="books" value = "1">Книги</button>
<br /><br />

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

<a href="pages/addauthors.html">Добавить автора</a>
<br />
<a href="pages/uppauthors.html">Изменить данные автора</a>
<br />
<a href="pages/delauthors.html">Удалить автора</a>
<br /><br />
<a href="pages/addbook.html">Добавить гнигу</a>
<br />
<a href="pages/uppbook.html">Изменить данные книги</a>
<br />
<a href="pages/delbook.html">Удалить книгу</a>
<br /><br />
<div id="block"></div>
<?php
Pages::endPage();

