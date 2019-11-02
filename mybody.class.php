<?php
class mybody {
	
	
//obliczanie zapotrzebowania kalorycznego
public function ileKcal($plec,$waga,$wzrost,$wiek,$tryb){
	//jeżeli mężczyzna(true)
	if($plec){
		$przemiana = 66.5 + (13.7 * $waga) + (5 * $wzrost) - (6.8 * $wiek);
		//jeżeli kobieta
	} else {
		$przemiana = 655 + (9.6 * $waga) + (1.85 * $wzrost) - (4.7 * $wiek);
		
	}
	
	$zapotrzebowanie = round($przemiana * $tryb);
	
	return $zapotrzebowanie;
	
}

//obliczanie wskaźnika BMI

public function getBmi ($waga,$wzrost) {
	$bmi = round($waga / pow(($wzrost/100),2),2); //wzrost w metrach oraz zaokrąglenie do dwóch miejsc po przecinku
	return $bmi; 
}

//sprawdzanie BMI
public function checkBmi ($bmi) { 
$result = '';
if ($bmi < 18.5) $result .= ' Masz niedowagę<br />';
if (18.5 <= $bmi  && $bmi < 25) $result .= ' Twoja waga jest prawidłowa!<br />';
if (25 <= $bmi && $bmi < 30) $result .= ' Masz nadwagę<br />';
if ($bmi >= 30) $result .= ' To już oznacza otyłość, nie poddawaj się!<br />';

return $result;
}


}



?>
