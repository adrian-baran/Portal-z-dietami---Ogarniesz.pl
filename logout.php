<?php
session_start();
require 'header.php';

session_destroy();
$_SESSION = array ();
echo '<p class="success">Dziękujemy za wizytę ;) <a href="index.php"> Strona główna</a></p>';

require 'footer.php';

?>