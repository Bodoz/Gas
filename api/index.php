<?php
//ROUTE
header('Content-type: application/json; charset=UTF-8');

session_start();
$f3 = require('lib/base.php');
require_once 'db.php';

///////////////////////////////////////////////////////////////////////////////////////////////////
///  U S E R S
//////////////////////////////////////////////////////////////////////////////////////////////////

$f3->route(
    'GET /users/authorized',
    function ($f3, $params) {
        if ( isset($_SESSION['user'])){
            $r = [
                'result' => true,
                'data' => $_SESSION['user'],
                'msg' => 'you are logged in'
            ];
        }else {
            $r = [
                'result' => false,
                'data' => false,
                'msg' => 'you are NOT logged in'
            ];
        }
        echo json_encode($r);
    }
);

$f3->route(
    'POST /users/authorize',
    function ($f3, $params) {
        $data = json_decode(file_get_contents('php://input'), true);
        if ($data && $data['username'] != '' && $data['password'] != '') {
            $user = get_user($data['username']);
            if ($user && md5($data['password']) == $user['password']) {
                unset($user['password']);
                $r = [
                    'result' => true,
                    'data' => $user,
                    'msg' => 'you are logged in'
                ];
                $_SESSION['user'] = $r['data'];
            }else {
                $r = [
                    'result' => false,
                    'data' => null,
                    'msg' => 'invalid username or password'
                ];
                unset($_SESSION['user']);
            }
        } else {
            $r =  [
                'result' => false,
                'data' => null,
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

//Aggiungere un nuovo gas
$f3->route(
    'POST /gas',
    function ($f3, $params) {
        $data = json_decode(file_get_contents('php://input'), true);
        if ($data['nome'] != '' and $data['descrizione'] != '' and $data['via'] != '' and $data['civico'] != '' and $data['paese'] != '' and $data['provincia'] != '') {
            $gas = add_gas($data['nome'], $data['descrizione'], $data['via'], $data['civico'], $data['paese'], $data['provincia']);
            $r = [
                'result' => true,
                'data' => [$gas],
                'msg' => 'Ok'
            ];
        } else {
            $r =  [
                'result' => false,
                'data' => [],
                'msg' => 'Dati forniti non validi'
            ];
            http_response_code(400);
        }
        echo json_encode($r);
    }
);

// Modificare un gas
$f3->route('PUT /gas/@id',
    function($f3, $params) {
        $data =  json_decode(file_get_contents('php://input'), true);
        if ($params['id_gas'] > 0 && $data['nome'] != '' && $data['descrizione'] != '' && $data['via'] != '' && $data['civico'] != '' && $data['paese'] != '' && $data['provincia'] != '') {
            $gas = save_gas($params['id_gas'], $data['nome'], $data['descrizione'], $data['via'], $data['civico'], $data['paese'], $data['provincia']);

            $r = [
                'result' => true,
                'data' => [$gas],
                'msg' => 'Correct'
            ];
            http_response_code(201);
        } else {
            $r = [
                'result' => false,
                'data' => [null],
                'msg' => 'Error'
            ];
            http_response_code(400);
        }
        echo json_encode($r);
    }
);

//Eliminare un gas
$f3->route(
    'DELETE /gas/@id',
    function ($f3, $params) {
        $gas = get_gas($params['id']);
        del_gas($params['id']);
        if ($gas) {
            $r =  [
                'result' => true,
                'data' => [$gas],
                'msg' => 'Ok'
            ];
        } else {
            $r =  [
                'result' => false,
                'data' => [],
                'msg' => 'Ko'
            ];
            http_response_code(404);
        }
        echo json_encode($r);
    }
);

//get all
$f3->route(
    'GET /*',
    function () {
        echo 'I am the catch em all!';
    }
);

$f3->run();