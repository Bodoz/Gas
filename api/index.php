<?php
//ROUTE

header('Content-type: application/json; charset=UTF-8');

$f3 = require('lib/base.php');
require_once 'db.php';

$f3 -> route( 'GET /users',
    function ($f3, $params){
        echo json_encode([
                'result' => true,
                'data' => get_users(),
                'msg' => 'elenco utenti'
        ]);
    }
);

$f3->route(
    'GET /*',
    function () {
        echo 'I am the catch em all!';
    }
);

$f3->run();