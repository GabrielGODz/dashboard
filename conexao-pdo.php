<?php

define('username', 'if0_36511511');
define('password', 'Senac2024');

try {
    $conn = new PDO('mysql:host=sql307.infinityfree.com; dbname=if0_36511511_senac', username, password);
}catch(PDOException $e){
    echo "Error: ". $e -> getMessage();
    exit;
}