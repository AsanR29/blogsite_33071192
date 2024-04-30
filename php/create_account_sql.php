<?php

function createAccount($username, $password, $type){
    $db = new SQLite3('C:\xampp\htdocs\blogsite_33071192\data\database.db');
    $sql = 'SELECT COUNT(*) FROM Accounts WHERE username=:username';
    $stmt = $db->prepare($sql);
    $stmt->bindParam(':username', $username, SQLITE3_TEXT);
    $result = $stmt->execute();

    $row = $result->fetchArray();
    if($row[0] > 0){
        return false;   //username is taken
    }

    $sql = 'INSERT INTO Accounts(username, password, type) VALUES(:username, :password, :type)';
    $stmt = $db->prepare($sql);
    $stmt->bindParam(':username', $username, SQLITE3_TEXT);
    $stmt->bindParam(':password', $password, SQLITE3_TEXT);
    $stmt->bindParam(':type', $type, SQLITE3_INTEGER);
    $result = $stmt->execute();
    return true;
}

?>