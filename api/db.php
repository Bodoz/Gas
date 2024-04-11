<?php
//QUERY

$db = new PDO('sqlite:gasDB');

///////////////////////////////////////////////////////////////////////////////////////////////////
///  U S E R S
//////////////////////////////////////////////////////////////////////////////////////////////////

function get_users(){
    global $db;

    $sql = "SELECT * FROM utenti";
    $stmt = $db -> prepare($sql);
    $stmt -> execute();
    $users = $stmt -> fetchAll(PDO::FETCH_ASSOC); //fetchAll se ottengo più righe dalla query
    return $users;
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

    $sql = "UPDATE todoes SET 
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