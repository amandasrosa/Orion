<?php
$dsn = 'mysql:host=localhost;dbname=orion';
$username = 'root';
$password = '';
$options = array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION);

try {
    $db = new PDO($dsn, $username, $password, $options);
} catch (PDOException $e) {
    $error_message = $e->getMessage();
    echo $error_message;
    exit;
}

function display_db_error($error_message) {
    echo $error_message;
}
?>