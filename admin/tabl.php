<?php
$mysqli = new mysqli("localhost", "newbook", "test", "newbook");
if ($mysqli->connect_errno) {
    echo "Не удалось подключиться к MySQL: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error;
}
include "Pages.php";
Pages::beginPage("Моя библиоьека");
include "admin/Authors.php";
include "admin/Books.php";
?>
<h1>Моя библиотека</h1>
<form  method="POST">
    <strong>Фамилия автора</strong>
    <input type="text" name="lastff" value="<?php echo @$data['lastff']; ?>">
    <button type="submit" name="authors">Авторы</button>
    <strong>Наименование книги</strong>
    <input type="text" name="nameff" value="<?php echo @$data['nameff']; ?>">
    <button type="submit" name="books">Книги</button>

</form>
<?php
$data = $_POST;
$books = new Books($mysqli);
$authors = new Authors($mysqli, $books);

if (isset($data['authors'])) {
    $authors->getAuthors($data['lastff'], $mysqli);
}
if (isset($data['books'])) {
    $books->getBooks($data['nameff']);
}
if (isset($_GET['author'])) {
    $rr = $books->selBooks($_GET['author']);
    foreach ($rr as $value) {
        echo "<br />";
        foreach ($value as $k => $v) {
            if ($k % 2 == 0)
                echo " Название: " . $v;
            else
                echo " ID: " . $v;
        }
    }
}
Pages::endPage()

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

<form id = "myForm">
    <table id="myTable" border="15" bordercolor = '#008a77' cellpadding = "5" cellspacing="0"bgcolor="#4EAEC1">
        <th align = "center" bgcolor = "blue" >

            <a style='background-color: #F7EBCC;font-size:25px'>Меню</a>


        </th>
        <tr>
                <td align = "center" bgcolor = "green" >

            <a style='background-color: #F7EBCC;font-size:25px'>Поиск</a>


        </td>
        </tr>

        <tr align = "center" >
            <td Width = 200>
                <input type="submit"value="Поиск по автору"ONCLICK="isMore();"id="myIn"/>
            </td>

        </tr>

        <tr align = "center">
            <td Width = 200>
                <input type="submit" value="Поиск по книге" METHOD="POST"/>
                <!--поставьте здесь атрибут action-->
            </td>

        </tr>
        <tr align = "center">
            <td Width = 200>
                <input type="submit" value="Добавить автора" METHOD="POST"/>
                <!--поставьте здесь атрибут action-->
            </td>
        </tr>
                <tr align = "center">
            <td Width = 200>
                <input type="submit" value="Добавить книгу" METHOD="POST"/>
                <!--поставьте здесь атрибут action-->
            </td>
        </tr>
    </table>
</form>