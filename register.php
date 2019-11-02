<?php


require 'header.php'; 
require 'config.php'; 
require_once 'user.class.php';


if ($_POST['register'] == 1) {
	//ochrona przed sql injection
    $login = mysql_real_escape_string(htmlspecialchars($_POST['login']));
    $password = mysql_real_escape_string(htmlspecialchars($_POST['password']));
    $password_valid = mysql_real_escape_string(htmlspecialchars($_POST['password_valid']));
    $email = mysql_real_escape_string(htmlspecialchars($_POST['email']));
    $email_valid = mysql_real_escape_string(htmlspecialchars($_POST['email_valid']));

   //czy email i login są zajęte
    $existsLogin = mysql_fetch_array(mysql_query("SELECT COUNT(*) FROM users WHERE login='$login' LIMIT 1"));
    $existsEmail = mysql_fetch_array(mysql_query("SELECT COUNT(*) FROM users WHERE email='$email' LIMIT 1"));

    $errors = ''; // utworzenie pustej listy błędów


    // Sprawdzenie, czy nie wystąpiły błędy
    if (!$login || !$email || !$password || !$password_valid || !$email_valid ) $errors .= '- Musisz wypełnić wszystkie pola<br />';
    if ($existsLogin[0] >= 1) $errors .= '- Ten login jest zajęty<br />';
    if ($existsEmail[0] >= 1) $errors .= '- Ten e-mail jest już używany<br />';
    if ($email != $email_valid) $errors .= '- E-maile się nie zgadzają<br />';
    if ($password != $password_valid)  $errors .= '- Hasła się nie zgadzają<br />';
	if (strlen($password) < 6) $errors .='Twoje hasło musi mieć minimum 6 znaków<br />';
	
	// Sprawdzenie poprawności adresu email
	$checkEmail = user::checkEmail ($email);
	if (!$checkEmail) $errors.='Nieprawidłowy email<br />';

    // wyświetlenie błędów, o ile istnieją
    if ($errors != '') {
        echo '<p class="error">Rejestracja nie powiodła się, popraw następujące błędy:<br />'.$errors.'</p>';
    }

    // jeśli błędy nie istnieją
    else {

        // zabezpieczenie hasła 
        $password = user::passwordSalter($password);

        // Zapisz dane do bazy
        mysql_query("INSERT INTO users (login, email, password) VALUES('$login','$email','$password');") or die ('<p class="error">Wystąpił błąd w zapytaniu i nie udało się zarejestrować użytkownika.</p>');

        echo '<p class="success">'.$login.', zostałeś zarejestrowany.
        <br /><a href="login.php">Logowanie</a></p>';
    }
}
?>

<form method="post" action="">
 <label for="login">Login:</label>
 <input maxlength="32" type="text" name="login" id="login" />

 <label for="pass">Hasło:</label>
 <input maxlength="32" type="password" name="password" id="password" />

 <label for="pass_again">Hasło (ponownie):</label>
 <input maxlength="32" type="password" name="password_valid" id="pass_again" />

 <label for="email">Email:</label>
 <input type="text" name="email" maxlength="50" id="email" />

 <label for="email_again">Email (ponownie):</label>
 <input type="text" maxlength="255" name="email_valid" id="email_again" /><br />


 <input type="hidden" name="register" value="1" />
 <input type="submit" value="Zarejestruj" />
</form>

<?php
require 'footer.php'; 
?>