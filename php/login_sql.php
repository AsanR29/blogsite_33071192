<?php

function accountLogin($username, $password){
    $db = new SQLite3('C:\xampp\htdocs\blogsite_33071192\data\database.db');
    $sql = 'SELECT account_id FROM Accounts WHERE username=:username AND password=:password';

    $stmt = $db->prepare($sql);
    $stmt->bindParam(':username', $username, SQLITE3_TEXT);
    $stmt->bindParam(':password', $password, SQLITE3_TEXT);
    $result = $stmt->execute();

    $row = $result->fetchArray();
    return $row[0]; //account_id
}

?>