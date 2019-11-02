<?php
//tablica konfiguracyjna bazy danych
$config['db_server'] = 'localhost';
$config['db_username'] = 'xxx';
$config['db_password'] = 'xxx';
$config['db_name'] = 'xxx';

//połączenie z bazą
$connect = @mysql_connect($config['db_server'], $config['db_username'],$config['db_password']);
$select = @mysql_select_db($config['db_name'], $connect);

if($connect == false) { 
die('<p class="error">Błąd podczas łączenia z bazą danych</p>');
} 

if($select == false) { 
die ('<p class="error">Błąd podczas wyboru bazy danych</p>');
}

?>