<?php require_once 'start.php'; 



$user = new Auth\User (igor, 111);

$login = 'spspsp';
$password = 111;
$email = 'oper@mail.ru';
$username = 'zz';
$salt = 123;

$stmt = $user->trtrtr();
echo 1;
$i = 0;
foreach($stmt as $rows) {
    echo $rows[0];
    //echo $rows[1];
    //echo $rows[2];
    //echo $rows[3];
    //echo $rows[4];
}
//print_2($a);
