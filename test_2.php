<?php require_once 'start.php'; 



$user = new Auth\User (igor, 111);

$login = 'spspsp';
$password = 111;
$email = 'oper@mail.ru';
$username = 'zz';
$salt = 123;

$stmt = $user->trtrtr();
echo 1;
foreach($stmt as $rows) {
    print_r($rows);
}
//print_2($a);
