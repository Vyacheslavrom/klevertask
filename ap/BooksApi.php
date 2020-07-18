<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
?>
<?php

class BooksApi extends Api {

    public $apiName = 'books';

    //function __construct() {
    //$this -> obj = new Books;
    //}

    /**
     * Метод GET
     * Вывод списка всех записей
     * http://ДОМЕН/users
     * @return string
     */
    public function indexAction() {
        //$db = (new Db())->getConnect();
        $users = $this->obj->getBooks('', 'vse');
        if ($users) {
            return $this->response($users, 200);
        }

        return $this->response('Data not found', 404);
    }

    /**
     * Метод GET
     * Просмотр отдельной записи (по id)
     * http://ДОМЕН/users/1
     * @return string
     */
    public function viewAction() {
        //id должен быть первым параметром после /users/x
        $id = array_shift($this->requestUri);

        if ($id) {
            //$db = (new Db())->getConnect();
            // $user = Users::getById($db, $id);
            $user = $this->obj->getBooks($id, 'id');
            if ($user) {
                return $this->response($user, 200);
            }
        }
        return $this->response('Data not found', 404);
    }

    /**
     * Метод POST
     * Создание новой записи
     * http://ДОМЕН/users + параметры запроса name, email
     * @return string
     */
    public function createAction() {
        $name = $this->requestParams['name'] ?? '';
        $ida = $this->requestParams['ida'] ?? '';
        //print_r($_REQUEST);
        if ($name && $ida) {
            // $db = (new Db())->getConnect();
            $user = $this->obj->addBooks($name, $ida);
            //$user = new Users($db, [
            //  'name' => $name,
            //'email' => $email
            //]);
            if ($user = 'книга добавлена') {
                //echo 'я утут';
                return $this->response('Data saved.', 200);
            }
        }
        return $this->response("Saving error", 500);
    }

    /**
     * Метод PUT
     * Обновление отдельной записи (по ее id)
     * http://ДОМЕН/users/1 + параметры запроса name, email
     * @return string
     */
    public function updateAction() {
        $parse_url = parse_url($this->requestUri[0]);
        $id = $parse_url['path'] ?? null;

        //$db = (new Db())->getConnect();
        //if (!$userId || !Users::getById($db, $userId)) {
        //return $this->response("User with id=$id not found", 404);
        //}

        $name = $this->requestParams['name'] ?? '';
        $ida = $this->requestParams['ida'] ?? '';
        if ($name && $ida && $id) {
            $user = $this->obj->uppBooks($name, $ida, $id);
            if ($user = 'данные книги обновлены') {
                return $this->response('Data updated.', 200);
            }
        }
        return $this->response("Update error", 400);
    }

    /**
     * Метод DELETE
     * Удаление отдельной записи (по ее id)
     * http://ДОМЕН/users/1
     * @return string
     */
    public function deleteAction() {
        $parse_url = parse_url($this->requestUri[0]);
        $id = $parse_url['path'] ?? null;

        //$db = (new Db())->getConnect();
        //if (!$userId || !Users::getById($db, $userId)) {
        // return $this->response("User with id=$userId not found", 404);
        // }
        $user = $this->obj->delBooks($id);
        if ($user = 'книга удалена') {
            return $this->response('Data deleted.', 200);
        }
        return $this->response("Delete error", 500);
    }

}
