<?php
//tablica konfiguracyjna bazy danych
$config['db_server'] = 'localhost';
$config['db_username'] = '00268814_ogarniesz';
$config['db_password'] = 'Qazqaz1212!';
$config['db_name'] = '00268814_ogarniesz';

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