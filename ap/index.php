<?php

// frid 
require_once '../admin/Authors.php';
require_once '../admin/Books.php';
require_once 'Api.php';


try {
    $rez = explode('/', trim($_SERVER['REQUEST_URI'], '/'));
    if (!isset($rez[1])) {
        require_once 'BooksApi.php';
        $api = new BooksApi(new Books());
    } else {

        switch ($rez[1]) {
            case 'books' :
                require_once 'BooksApi.php';
                $api = new BooksApi(new Books());
                break;
            case 'authors' :
                require_once 'AuthorsApi.php';
                $api = new AuthorsApi(new Authors);
                break;
            default:

                break;
        }
    }

    echo $api->run();
} catch (Exception $e) {
    echo json_encode(Array('error' => $e->getMessage()));
}