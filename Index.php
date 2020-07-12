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
Pages::endPage();