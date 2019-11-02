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
	
	$zapotrzebowanie = $przemiana * $tryb;
	
	return $zapotrzebowanie;
	
}


}



?>