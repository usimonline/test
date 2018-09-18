<?php require_once 'start.php'; 



$user = new Auth\User (igor, 111);

echo 'begin <br>';
$stmt = $user->save_xml();
echo '<br> end';

echo 'begin <br>';

$xml_basa = '<?xml version="1.0" encoding="utf-8"?>
<pma_xml_export version="1.0" xmlns:pma="https://www.phpmyadmin.net/some_doc_url/">
    <database name="u689193950_base">';

$i = 0;
foreach($stmt as $rows) {

    $xml_basa = $xml_basa .'
        <table name="users">
            <column name="id">'.$rows[0].'</column>
            <column name="login">'.$rows[1].'</column>
            <column name="password">'.$rows[2].'</column>
            <column name="email">'.$rows[3].'</column>
            <column name="username">'.$rows[4].'</column>
            <column name="salt">'.$rows[5].'</column>
        </table>';
}

$xml_basa = $xml_basa.'
    </database>
</pma_xml_export>';

file_put_contents('users.xml', $xml_basa);

