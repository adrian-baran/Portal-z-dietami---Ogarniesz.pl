<?php
//podstawowe operacje dla usera

class user {

//$user - będzie zawierał wszystkie informacje z bazy o użytkowniku
    public static $user = array();
    
   
    public function getData ($login, $password) {
        if ($login == '') $login = $_SESSION['login'];
        if ($password == '') $password = $_SESSION['password'];

        self::$user = mysql_fetch_array(mysql_query("SELECT * FROM users WHERE login='$login' AND password='$password' LIMIT 1;"));
        return self::$user;
    }

    
    // wyszukanie usera po numerze id
    public function getDataById ($id) {
        $user = mysql_fetch_array(mysql_query("SELECT * FROM users WHERE id='$id' LIMIT 1;"));
        return $user;
    }
	
	// walidacja adresu email
	public function checkEmail ($email) {
		$temp = $sprawdz = '/^[a-zA-Z0-9.\-_]+@[a-zA-Z0-9\-.]+\.[a-zA-Z]{2,4}$/';
		$result = preg_match($temp, $email);
		return $result;
	}

    //funkcja informująca o tym czy użytkownik jest zalogowany - zwraca prawda/fałsz
    public function isLogged () {
     if (empty($_SESSION['login']) || empty($_SESSION['password'])) {
      return false;
     }

     else {
      return true;
     }
    }

    //zabezpieczenie hasła, tzw."posolenie"
    public function passwordSalter ($password) {
        $password = '!@#!$aA'.$password.'dF#2!@';
        return md5($password);
    }

}

