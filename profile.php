<?php
session_start();

require 'header.php'; 
require 'config.php'; 
require_once 'user.class.php';
require_once 'mybody.class.php';

//jeżeli ktoś nie jest zalogowany
if (!user::isLogged()) {
    echo '<p class="error">Przykro nam, ale ta strona jest dostępna tylko dla zalogowanych użytkowników.</p>';
}

else {
	
     $id = $_GET['id'];

    //czy uzytkownik o podanym id istnieje
    $userExist = mysql_fetch_array(mysql_query("SELECT COUNT(*) FROM users WHERE id = '$id'"));

    // jezeli nie istnieje
    if ($userExist[0] == 0) {
        die ('<p>Przykro nam, taki użytkownik nie istnieje</p>');
    }

    
    
    // zapisanie danych usera do $id
    $profile = user::getDataById ($id);
    
    echo '<h1>Profil użytkownika '.$profile['login'].'</h1>';

    echo '<b>Nick:</b> '.$profile['login'].'<br />';
    echo '<b>Email:</b> '.$profile['email'].'<br />';
	//dane obliczone dzięki klasie mybody.class.php
	//identyfikacja płci
	if (!$profile['plec'] > 0) {
		$plec = false; //kobieta
	} else {
		$plec = true;
	}
	//zapotrzebowanie kaloryczne
	
	$zapotrzebowanie = mybody::ileKcal($plec,$profile['waga'],$profile['wzrost'],$profile['wiek'],$profile['tryb']);
	echo '<b>Zapotrzebowanie kaloryczne:</b> '.$zapotrzebowanie. ' kcal <br />';
	
	//bmi
	$bmi = mybody::getBmi ($profile['waga'],$profile['wzrost']);
	echo '<b>Twoje BMI:</b> '.$bmi.' <br />';
	
	//Co oznacza wynik bmi
	$checkBmi = mybody::checkBmi($bmi);
	echo '<b>'.$checkBmi.'</b> <br />';
	
	

}

require 'footer.php';

?>
