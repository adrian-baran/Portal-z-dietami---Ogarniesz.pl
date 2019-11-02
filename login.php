<?php
session_start();
require 'header.php'; // Dołącz początkowy kod HTML
require 'config.php'; // Dołącz plik konfiguracyjny i połączenie z bazą

/**
 * SKRYPT LOGOWANIA
 */
require_once 'user.class.php'; // Dołączamy rdzeń systemu użytkowników

// Zabezpiecz zmienne odebrane z formularza, przed atakami SQL Injection
$login = htmlspecialchars(mysql_real_escape_string($_POST['login']));
$password = mysql_real_escape_string($_POST['pass']);

if ($_POST['send'] == 1) {
    // Sprawdź, czy wszystkie pola zostały uzupełnione
    if (!$login or empty($login)) {
        die ('<p class="error">Wypełnij pole z loginem!</p>');
    }

    if (!$password or empty($password)) {
        die ('<p class="error">Wypełnij pole z hasłem!</p>');
    }

    $password = user::passwordSalter($password); // Posól i zahashuj hasło
    
    // Sprawdź, czy użytkownik o podanym loginie i haśle isnieje w bazie danych
    $userExists = mysql_fetch_array(mysql_query("SELECT COUNT(*) FROM users WHERE login = '$login' AND password = '$password'"));

    if ($userExists[0] == 0) {
        // Użytkownik nie istnieje w bazie
        echo '<p class="error">Użytkownik o podanym loginie i haśle nie istnieje.</p>';
    }

    else {
        // Użytkownik istnieje
        $user = user::getData($login, $password); // Pobierz dane użytknika do tablicy i zapisz ją do zmiennej $user

        // Przypisz pobrane dane do sesji
        $_SESSION['login'] = $login;
        $_SESSION['password'] = $password;

        echo '<p class="success">Zostałeś zalogowany. Możesz przejść na <a href="index.php">stronę główną</a></p>';
    }
}

else {
    /**
     * FORMULARZ LOGOWANIA
     */
?>

 <form method="post" action="">
  <label for="login">Login:</label>
  <input type="text" name="login" maxlength="32" id="login" />

  <label for="pass">Hasło:</label>
  <input type="password" name="pass" maxlength="32" id="pass" /><br />

  <input type="hidden" name="send" value="1" />
  <input type="submit" value="Zaloguj" />
 </form>

<?php
}

require 'footer.php'; // Dołącz końcowy kod HTML
?>