<?php require_once 'start.php'; 



$user = new Auth\User (igor, 111);

$login = 'spspsp';
$password = 111;
$email = 'oper@mail.ru';
$username = 'zz';
$salt = 123;

$stmt = $user->trtrtr();
//echo 1;
$i = 0;
foreach($stmt as $rows) {
    echo $rows[0].' ';
    echo $rows[1].' ';
    echo $rows[2].' ';
    echo $rows[3].' ';
    echo $rows[4].'<br>';
}



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

   // echo $rows[0].' ';
   // echo $rows[1].' ';
   // echo $rows[2].' ';
  //  echo $rows[3].' ';
   // echo $rows[4].'<br>';
}



     //   for($i = 0; $i < $total; $i++) {
          //  $n_l_u = $news_latest[$i]['url'];
          //  $n_l_date = DateTime::createFromFormat('Y-m-d H:i:s', $news_latest[$i]['datetime'])->format('Y-m-d\TH:i:sP');
          //  $n_l_u_mass = explode( '/', $n_l_u);
          //  if($n_l_u_mass[2] == '2018' or $n_l_u_mass[2] == '2019' ) {
         //       $xml_basa = $xml_basa . '
          //      <url>
           //     <loc>' . $main_name . $n_l_u . '</loc>
          //      <lastmod>' . $n_l_date . '</lastmod>
          //      <priority>0.9</priority>
          //      </url>';
        //    }
     //   }

$xml_basa = $xml_basa.'
    </database>
</pma_xml_export>';

file_put_contents('users.xml', $xml_basa);