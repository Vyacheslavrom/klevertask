<?php
include "../pages.php";
Pages::beginPage("Админская страничка");
?>
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
<?php
Pages::endPage();
include "Authors.php";
