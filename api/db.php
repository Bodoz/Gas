<?php
//QUERY

$db = new PDO('sqlite:gasDB');

///////////////////////////////////////////////////////////////////////////////////////////////////
///  U S E R S
//////////////////////////////////////////////////////////////////////////////////////////////////

function add_user($username, $password, $nome, $cognome, $email, $via, $cap, $paese, $provincia) {
    global $db;

    $sql = "INSERT INTO users (username, password, nome, cognome, email, via, cap, paese, provincia)
            VALUES (:username, :password, :nome, :cognome, :email, :via, :cap, :paese, :provincia)";
    $stmt = $db->prepare($sql);

    $stmt->bindValue(':username', $username);
    $stmt->bindValue(':password', md5($password));
    $stmt->bindValue(':nome', $nome);
    $stmt->bindValue(':cognome', $cognome);
    $stmt->bindValue(':email', $email);
    $stmt->bindValue(':via', $via);
    $stmt->bindValue(':cap', $cap);
    $stmt->bindValue(':paese', $paese);
    $stmt->bindValue(':provincia', $provincia);

    $stmt->execute();

    $id = $db->lastInsertId();
    return get_user($id);

    //TODO Restituire un errore
}

function get_user($id){
    global $db;

    $sql = "SELECT * FROM users WHERE id = :id";
    $stmt = $db->prepare($sql);
    $stmt->bindValue(':id', $id);
    $stmt->execute();
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    if($user) {
        $sql = "SELECT * FROM roles R 
            LEFT JOIN user_roles UR ON UR.role_id = R.id
            WHERE UR.user_id = :user_id";
        $stmt = $db->prepare($sql);
        $stmt->bindValue(':user_id', $user['id']);
        $stmt->execute();
        $roles = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $user['roles'] = $roles;
    }

    return $user;
}

function get_user_username($username){
    global $db;

    $sql = "SELECT * FROM users WHERE username = :username";
    $stmt = $db->prepare($sql);
    $stmt->bindValue(':username', $username);
    $stmt->execute();
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    if($user) {
        $sql = "SELECT * FROM roles R 
            LEFT JOIN user_roles UR ON UR.role_id = R.id
            WHERE UR.user_id = :user_id";
        $stmt = $db->prepare($sql);
        $stmt->bindValue(':user_id', $user['id']);
        $stmt->execute();
        $roles = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $user['roles'] = $roles;
    }

    return $user;
}
function get_users(){
    global $db;

    $sql = "SELECT * FROM users";
    $stmt = $db -> prepare($sql);
    $stmt -> execute();
    $users = $stmt -> fetchAll(PDO::FETCH_ASSOC); //fetchAll se ottengo più righe dalla query
    return $users;
}

function del_user($id) {
    global $db;

    $sql = "DELETE FROM users WHERE id = :id";
    $stmt = $db->prepare($sql);
    $stmt->bindValue(':id', $id);
    $stmt->execute();
}

///////////////////////////////////////////////////////////////////////////////////////////////////
///  G A S
//////////////////////////////////////////////////////////////////////////////////////////////////

function get_gass(){
    global $db;

    $sql = "SELECT * FROM gass";
    $stmt = $db -> prepare($sql);
    $stmt -> execute();
    $gass= $stmt -> fetchAll(PDO::FETCH_ASSOC); //fetchAll se ottengo più righe dalla query
    return $gass;
}

function get_gas($id_gas) {
    global $db;

    $sql = "SELECT * FROM gass WHERE id_gas = :id_gas";
    $stmt = $db->prepare($sql);
    $stmt->bindValue(':id_gas', $id_gas);
    $stmt->execute();
    $gas = $stmt->fetch(PDO::FETCH_ASSOC);

    return $gas;
}

function del_gas($id_gas) {
    global $db;

    $sql = "DELETE FROM gass WHERE id_gas = :id_gas";
    $stmt = $db->prepare($sql);
    $stmt->bindValue(':id_gas', $id_gas);
    $stmt->execute();
}

function add_gas($nome, $descrizione, $via, $civico, $paese, $provincia) {
    global $db;

    $sql = "INSERT INTO gass (nome, descrizione, via, civico, paese, provincia) 
            VALUES (:nome, :descrizione, :via, :civico, :paese, :provincia)";
    $stmt = $db->prepare($sql);

    $stmt->bindValue(':nome', $nome);
    $stmt->bindValue(':descrizione', $descrizione);
    $stmt->bindValue(':via', $via);
    $stmt->bindValue(':civico', $civico);
    $stmt->bindValue(':paese', $paese);
    $stmt->bindValue(':provincia', $provincia);

    $stmt->execute();

    $id = $db->lastInsertId();
    return get_gas($id);

    //TODO Restituire un errore
}

function save_gas($id_gas, $nome, $descrizione, $via, $civico, $paese, $provincia) {
    global $db;

    $sql = "UPDATE gass SET 
                        nome = :nome, 
                        descrizione = :descrizione,
                        via = :via,
                        civico = :civico,
                        paese = :paese,
                        provincia = :provincia
                        WHERE id_gas = :id_gas;";
    $stmt = $db->prepare($sql);

    $stmt->bindValue(':id_gas', $id_gas);
    $stmt->bindValue(':nome', $nome);
    $stmt->bindValue(':descrizione', $descrizione);
    $stmt->bindValue(':via', $via);
    $stmt->bindValue(':civico', $civico);
    $stmt->bindValue(':paese', $paese);
    $stmt->bindValue(':provincia', $provincia);

    $stmt->execute();

    return get_gas($id_gas);
}