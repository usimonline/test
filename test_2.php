<?php require_once 'start.php'; 



$user = new Auth\User (igor, 111);

echo 'begin <br>';
$stmt = $user->save_xml();
echo '<br> end';
