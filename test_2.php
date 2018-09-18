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
    echo $rows[$login];
    echo $rows[$password];
    echo $rows[$email];
    echo $rows[$username];
    echo $rows[$solt];
}
//print_2($a);
