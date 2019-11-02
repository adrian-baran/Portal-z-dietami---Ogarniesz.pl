<?php
session_start();


require 'header.php';
require 'config.php';
require_once 'user.class.php';
?>

<p>Tekst widoczny dla każdego ;)</p>

<?php
if (user::isLogged()) {
    // jeżeli użytkownik jest zalogowany
    
    // pobieranie informacji o uzytkowniku i zapisanie do zmiennej $user
    $user = user::getData('', '');
    
    echo '<p>Jesteś zalogowany, witaj '.$user['login'].'!</p>';
    echo '<p>Możesz zobaczyć swój <a href="profile.php?id='.$user['id'].'">profil</a> albo się <a href="logout.php">wylogować</a></p>';
}

else {
    // jeżeli użytkownik nie jest zalogowany
    echo '<p>Nie jesteś zalogowany.<br /><a href="login.php">Zaloguj</a> się lub <a href="register.php">zarejestruj</a> jeśli jeszcze nie masz konta.</p>';
}

require 'footer.php';

?>