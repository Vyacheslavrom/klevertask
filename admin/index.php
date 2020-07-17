<?php
$mysqli = new mysqli("localhost", "newbook", "test", "newbook");
if ($mysqli->connect_errno) {
    echo "Не удалось подключиться к MySQL: (" . $mysqli->connect_errno . ") " . $mysqli->connect_error;
}
include "../pages.php";
Pages::beginPage("Админская страничка");
include "Authors.php";
include "Books.php";
?>
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
if (isset($data['authors']) || isset($data['addAuthors']) || isset($data['appAuthors']) || isset($data['delAuthors']) || isset($data['do_signup']) || isset($data['upp_signup']) || isset($data['del_signup'])):
    ?>
    <form  method="POST">

        <button type="submit" name="addAuthors">Добавить автора</button>
        <button type="submit" name="appAuthors">Изменить данные автора</button>
        <button type="submit" name="delAuthors">Удалить автора</button>
    </form>
    <?php if (isset($data['addAuthors']) || isset($data['do_signup'])): ?> 
        <form  method="POST">


            <strong>Фамилия автора</strong>
            <input type="text" name="last" value="<?php echo @$data['last']; ?>"><br/>

            <strong>Имя автора</strong>
            <input type="test" name="first" value="<?php echo @$data['first']; ?>"><br/>

            <strong>Отчество автора</strong>
            <input type="test" name="midl" value="<?php echo @$data['midl']; ?>"><br/>

            <button type="submit" name="do_signup">Добавить</button>

        </form>
        <?php
        if (isset($data['do_signup'])) {
            echo $authors->addAuthors($data['last'], $data['first'], $data['midl']);
        }
    endif;
    if (isset($data['appAuthors']) || isset($data['upp_signup'])):
        ?> 
        <form   method="POST">


            <strong>Фамилия автора</strong>
            <input type="text" name="last" value="<?php echo @$data['last']; ?>"><br/>

            <strong>Имя автора</strong>
            <input type="test" name="first" value="<?php echo @$data['first']; ?>"><br/>

            <strong>Отчество автора</strong>
            <input type="test" name="midl" value="<?php echo @$data['midl']; ?>"><br/>

            <strong>id автора которого нужно поменять</strong>
            <input type="test" name="id" value="<?php echo @$data['id']; ?>"><br/>


            <button type="submit" name="upp_signup">Изменить</button>

        </form>
        <?php
        if (isset($data['upp_signup'])) {
            echo $authors->uppAuthors($data['last'], $data['first'], $data['midl'], $data['id'], $data['idauthor']);
        }
    endif;
    if (isset($data['delAuthors']) || isset($data['del_signup'])):
        ?> 
        <form class = "login_text"  method="POST">


            <strong>id автора</strong>
            <input type="text" name="id" value="<?php echo @$data['id']; ?>"><br/>

            <button type="submit" name="del_signup">Удалить</button>

        </form>
        <?php
        if (isset($data['del_signup'])) {
            echo "<br />";
            echo $authors->delAuthors($data['id']);
            echo "<br />";
        }
    endif;
    echo "<br />";
    if ($data['lastff'] == '')
        $flag = 'vse';
    $d = $authors->getAuthors($data['lastff'], $flag);
               foreach ($d as $v1) {
                foreach ($v1 as $v2) {
                    $aut = $aut . " " . $v2;
                }
                $aut .= "<br />";
            }
            echo $aut;
    echo "<br />";
endif;

//--------------------------------------------------------------------------

if (isset($data['books']) || isset($data['addBooks']) || isset($data['appBooks']) || isset($data['delBooks']) || isset($data['do_signupbook']) || isset($data['upp_signupbook']) || isset($data['del_signupbook'])):
    ?>
    <form  method="POST">

        <button type="submit" name="addBooks">Добавить книгу</button>
        <button type="submit" name="appBooks">Изменить данные о книге</button>
        <button type="submit" name="delBooks">Удалить книгу</button>
    </form>
    <?php if (isset($data['addBooks']) || isset($data['do_signupbook'])): ?> 
        <form  method="POST">


            <strong>Название книги</strong>
            <input type="text" name="name" value="<?php echo @$data['name']; ?>"><br/>

            <strong>id автора который ее написал</strong>
            <input type="test" name="ida" value="<?php echo @$data['ida']; ?>"><br/>

            <button type="submit" name="do_signupbook">Добавить</button>

        </form>
        <?php
        if (isset($data['do_signupbook'])) {
            echo $books->addBooks($data['name'], $data['ida']);
        }
    endif;
    if (isset($data['appBooks']) || isset($data['upp_signupbook'])):
        ?> 
        <form   method="POST">


            <strong>Наименование книги</strong>
            <input type="text" name="name" value="<?php echo @$data['name']; ?>"><br/>

            <strong>id книги которую нужно замнить</strong>
            <input type="test" name="id" value="<?php echo @$data['id']; ?>"><br/>

            <strong>id автора который ее написал</strong>
            <input type="test" name="ida" value="<?php echo @$data['ida']; ?>"><br/>

            <button type="submit" name="upp_signupbook">Изменить</button>

        </form>
        <?php
        if (isset($data['upp_signupbook'])) {
            echo $books->uppBooks($data['name'], $data['ida'], $data['id']);
        }
    endif;
    if (isset($data['delBooks']) || isset($data['del_signupbook'])):
        ?> 
        <form   method="POST">


            <strong>id книги</strong>
            <input type="text" name="id" value="<?php echo @$data['id']; ?>"><br/>

            <button type="submit" name="del_signupbook">Удалить</button>

        </form>
        <?php
        if (isset($data['del_signupbook'])) {
            echo $books->delBooks($data['id']);
        }
    endif;
    echo "<br />";
    echo "<div id ='a1'>";
    if ($data['nameff'] == '')
        $flag = 'vse';
    $d = $books->getBooks($data['nameff'], $flag);
    foreach ($d as $v1) {
        foreach ($v1 as $v2) {
            $aut = $aut . " " . $v2;
        }
        $aut .= "<br />";
    }
    echo $aut;
    echo "</div>";
    echo "<br />";
endif;
echo "<br />";

if (isset($_GET['famil'])) {
    $rr = $books->selBooks($_GET['famil'], "ida");
    foreach ($rr as $value) {
        echo "<br />";
        foreach ($value as $k => $v) {
            if ($k % 2 == 0) {
                echo " Название книги: " . $v;
            } else {
                echo " -автор: ";
                $arr1 = $authors->selAuthors($v, "ida");
                foreach ($arr1[0] as $v1) {
                    echo $v1 . " ";
                }
            }
        }
    }
}

Pages::endPage();

