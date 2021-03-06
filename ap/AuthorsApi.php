<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
$rez = explode('/', trim($_SERVER['REQUEST_URI'], '/'));
if ($rez[1] == 'authors')
    require_once 'Api.php';
?>
<?php

class AuthorsApi extends Api {

    public $apiName = 'authors';

    /**
     * Метод GET
     * Вывод списка всех записей
     * http://ДОМЕН/users
     * @return string
     */
    public function indexAction() {
        //$db = (new Db())->getConnect();
        $users = $this->obj->getAuthors('', 'vseandbook');
        if ($users) {
            return $this->response($users, 200);
        }
        echo 'я тут';
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
            $user = $this->obj->getAuthors($id, 'id');
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
        $last = $this->requestParams['last'] ?? '';
        $first = $this->requestParams['first'] ?? '';
        $midl = $this->requestParams['midl'] ?? '';

        if ($last && $first && $midl) {
            $user = $this->obj->addAuthors($last, $first, $midl);
            //$db = (new Db())->getConnect();
            //$user = new Users($db, [
            // 'name' => $name,
            //'email' => $email
            // ]);
            if ($user = 'автор добавлен') {
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
        //return $this->response("User with id=$userId not found", 404);
        // }

        $last = $this->requestParams['last'] ?? '';
        $first = $this->requestParams['first'] ?? '';
        $midl = $this->requestParams['midl'] ?? '';
        $user = $this->obj->uppAuthors($last, $first, $midl, $id);
        if ($last && $first && $midl && $id) {
            if ($user = 'данные автора обновлены') {
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
        //}
        $user = $this->obj->delAuthors($id);
        if ($user = 'автор удален') {
            return $this->response('Data deleted.', 200);
        }
        return $this->response("Delete error", 500);
    }

}
