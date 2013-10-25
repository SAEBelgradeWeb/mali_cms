<?php 

$db = mysql_connect(HOSTNAME, USERNAME, PASSWORD);

if( !$db ) {
	die("Konekcija sa serverom nije uspela!");

}

$dbd = mysql_select_db(DATABASE);

if ( !$dbd ) {
	die("Nismo uspeli da se povezemo na bazu " . DATABASE . "!");
}

 ?>