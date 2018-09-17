<!DOCTYPE html>
<html>
    <head>

<?php
             $db_host = "localhost";
             $db_name = "u689193950_base";
             $db_user = "u689193950_user";
             $db_pass = "111111";
            //$dp = new pdo("mysql:host=$db_host;dbname=$db_name", $db_user, $db_pass, array(PDO::MYSQL_ATTR_LOCAL_INFILE => 1));
            try {
               $dp = new pdo("mysql:host=$db_host;dbname=$db_name", $db_user, $db_pass, array(PDO::MYSQL_ATTR_LOCAL_INFILE => 1));
            } catch (\pdoexception $e) {
               echo "database error: " . $e->getmessage();
                die();
           }
            //$db->prepare('set names utf8');
            //$db->prepare("LOAD XML LOCAL INFILE 'users.xml' REPLACE INTO TABLE users ROWS IDENTIFIED BY '<database>'");
            $db->prepare('SELECT * from users');
            $db->execute();
            $a = $db->rowCount();
            echo $a;
            $db = null;