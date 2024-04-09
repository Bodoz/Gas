<?php
//ROUTE

$f3 = require('lib/base.php');
require_once 'db.php';
header('Content-type: application/json; charset=UTF-8');

///////////////////////////////////////////////////////////////////////////////////////////////////
///  U S E R S
//////////////////////////////////////////////////////////////////////////////////////////////////

$f3->route(
    'POST /users/authorize',
    function ($f3, $params) {
        $data = json_decode(file_get_contents('php://input'), true);
        if ($data['username'] != '' and $data['password'] != '') {
            if ($data['username'] == 'admin' and $data['password'] == '1234') {
                $r = [
                    'result' => true,
                    'data' => [
                        'id' => 1,
                        'username' => 'admin',
                        'role' => 'admin',
                    ],
                    'msg' => 'you are logged in'
                ];
                $_SESSION['user'] = 1;
            }else {
                $r = [
                    'result' => false,
                    'data' => [
                        'username' => false,
                        'role' => false,
                    ],
                    'msg' => 'you are NOT logged in'
                ];
                unset($_SESSION['user']);
            }
        } else {
            $r =  [
                'result' => false,
                'data' => [],
                'msg' => 'username or password empty, logged out'
            ];
            unset($_SESSION['user']);
        }
        echo json_encode($r);
    }
);

//elenco degli utenti
$f3 -> route(
    'GET /users',
    function ($f3, $params){
        echo json_encode([
                'result' => true,
                'data' => get_users(),
                'msg' => 'elenco utenti'
        ]);
    }
);

///////////////////////////////////////////////////////////////////////////////////////////////////
///  G A S
//////////////////////////////////////////////////////////////////////////////////////////////////

//elenco dei gass
$f3 -> route(
    'GET /gas',
    function ($f3, $params){
        echo json_encode([
            'result' => true,
            'data' => get_gass(),
            'msg' => 'elenco gas'
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