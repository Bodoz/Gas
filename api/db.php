<?php
//QUERY

$db = new PDO('sqlite:gasDB');

function get_users(){
    global $db;

    $sql = "SELECT * FROM utenti";
    $stmt = $db -> prepare($sql);
    $stmt -> execute();
    $users = $stmt -> fetchAll(PDO::FETCH_ASSOC); //fetchAll se ottengo più righe dalla query
    return $users;
}