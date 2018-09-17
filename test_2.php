<?php require_once 'start.php'; 



$user = new Auth\User (igor, 111);

$login = 'spspsp';
$password = 111;
$email = 'oper@mail.ru';
$username = 'zz';
$salt = 123;

$a = $user->trtrtr($login, $password, $email, $username, $salt);
echo $a;
