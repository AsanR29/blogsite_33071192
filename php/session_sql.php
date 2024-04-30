<?php

function deleteSessions($account_id){
    $db = new SQLite3('C:\xampp\htdocs\blogsite_33071192\data\database.db');
    $sql = 'DELETE FROM Sessions WHERE Sessions.account_id = :account_id';
    
    $stmt = $db->prepare($sql);
    $stmt->bindParam(':account_id', $account_id, SQLITE3_INTEGER);
    $result = $stmt->execute();
    
    return $result;
}

function createSession($account_id){
    $db = new SQLite3('C:\xampp\htdocs\blogsite_33071192\data\database.db');
    $success = false;
    $attempts = 0;
    $session_id = -1;
    while(!$success && ($attempts < 10) ){
        $session_id = rand();
        $sql = 'SELECT Count(*) FROM Sessions WHERE Sessions.session_id = :session_id';
        $stmt = $db->prepare($sql);
        $stmt->bindParam(':session_id', $session_id, SQLITE3_INTEGER);
        $result = $stmt->execute();
        $row = $result->fetchArray();
        if($row[0] == 0){
            $success = true;
        }
    }
    if(!$success){
        return false;
    }

    $sql = 'INSERT INTO Sessions(session_id, account_id) VALUES(:session_id, :account_id)';
    $stmt = $db->prepare($sql);
    $stmt->bindParam(':session_id', $session_id, SQLITE3_INTEGER);
    $stmt->bindParam(':account_id', $account_id, SQLITE3_INTEGER);
    $stmt->execute();
    return $session_id;
}

function loadSession($session_id){
    $db = new SQLite3('C:\xampp\htdocs\blogsite_33071192\data\database.db');
    $sql = 'SELECT * FROM Sessions WHERE Sessions.session_id = :session_id';
    $stmt = $db->prepare($sql);
    $stmt->bindParam(':session_id', $session_id, SQLITE3_INTEGER);
    $result = $stmt->execute();
    $row = $result->fetchArray();
    if(isset($row["account_id"])){
        return $row["account_id"];
    }
    else{
        return -1;
    }
}
?>