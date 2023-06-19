<?php
    //Tento kod kontroluje policky ve formulari pro praci a zapise to do DB.
    if(isset($_POST['post'])){
		$res = 0;
		$vacancy = trim(mysqli_real_escape_string($mysql, $_POST['vacancy']));
		$company = trim(mysqli_real_escape_string($mysql, $_POST['company']));
		$location = trim(mysqli_real_escape_string($mysql, $_POST['location']));
		$involvement = trim(mysqli_real_escape_string($mysql, $_POST['involvement']));
    	$vcdes = trim(mysqli_real_escape_string($mysql, $_POST['vcdes']));
		
		// Chyby pro zobrazeni
		$vacancyError = $companyError = $locationError = $involvementError = $vcdesError = "";

		//Validace

		// Kontrola pole vacancy
		if(empty($vacancy)){
			$vacancyError = "Vacancy field is required";
			$res++;
		}else if(mb_strlen(stripslashes($vacancy))  > 35) {
			$vacancyError = "The length of vacancy can have MAX 35 charachters";
			$res++;
		}else{
            $vacancyError = "";
		}
		// Kontrola pole company
		if(empty($company)){
			$companyError = "Vacancy field is required";
			$res++;
		}else if(mb_strlen(stripslashes($company)) > 35) {
			$companyError = "The length of company can have MAX 35 charachters";
			$res++;
		}else{
            $companyError = "";
		}

		// Kontrola pole location
		if(empty($location)){
			$locationError = "Vacancy field is required";
			$res++;
		}else if(mb_strlen(stripslashes($location)) > 35 ) {
			$locationError = "The length of location can have MAX 35 charachters";
			$res++;
		}else{
            $locationError = "";
		}

		// Kontrola pole involvement
		if(empty($involvement)){
			$involvementError = "Vacancy field is required";
			$res++;
		}else if(mb_strlen(stripslashes($involvement)) > 35 ) {
			$involvementError = "The length of involvement can have MAX 35 charachters";
			$res++;
		}else{
            $involvementError = "";
		}


		// Kontrola vacancy description
		if(empty($vcdes)){
			$vcdesError = "Vacancy field is required";
			$res++;
		}else if(mb_strlen(stripslashes($vcdes)) > 4000) {
			$vcdesError = "The length of vacancy description can have MAX 4000 charachters";
			$res++;
		}else{
            $vcdesError = "";
		}

		// Nahrani prispevku do DB, kdyz nedoslo k chybam
		if($res == 0){
			$mysql->query("INSERT INTO `jobs` (`vacancy`, `company`, `location`, `involvement`, `vcdes`) VALUES('$vacancy', '$company', '$location', '$involvement', '$vcdes')");
			$mysql->close();
			header('Location: ../index.php');
			exit();
		}
	}
	/*! \file
	Tento kod kontroluje policky ve formulari pro praci a zapise to do DB.
	1.	Pokud uzivatel stiskl tlacitko Post a job, vsechna odeslana data se zapisou do promennych.
		Promenna $res slouzi ke kontrole chyb, puvodni hodnota je 0. Pokud se pri vyplnovani formulare objevi chyba, tato promenna se zvysi o 1. 
	   	Vyplneni formulare je uspesne pouze tehdy, je-li tato promenna se rovna 0.
		\code
		if(isset($_POST['post'])){
			$vacancy = trim(mysqli_real_escape_string($mysql, $_POST['vacancy']));
			$company = trim(mysqli_real_escape_string($mysql, $_POST['company']));
			$location = trim(mysqli_real_escape_string($mysql, $_POST['location']));
			$involvement = trim(mysqli_real_escape_string($mysql, $_POST['involvement']));
    		$vcdes = trim(mysqli_real_escape_string($mysql, $_POST['vcdes']));
		\endcode	
	2.	Chyby pro zobrazeni.
		\code
		$vacancyError = $companyError = $locationError = $involvementError = $vcdesError = "";\
		\endcode

	3.	Validace policek. Nastaveni chyb.

		a.  Kontrola prazdnosti, delky pole vacancy
		\code
		if(empty($vacancy)){
			$vacancyError = "Vacancy field is required";
			$res++;
		}else if(mb_strlen($vacancy)  > 35) {
			$vacancyError = "The length of vacancy can have MAX 35 charachters";
			$res++;
		}else{
            $vacancyError = "";
		}
		\endcode

		b. Kontrola prazdnosti, delky pole company.
		\code
		if(empty($company)){
			$companyError = "Vacancy field is required";
			$res++;
		}else if(mb_strlen($company) > 35) {
			$companyError = "The length of company can have MAX 35 charachters";
			$res++;
		}else{
            $companyError = "";
		}
		\endcode

		c. Kontrola  prazdnosti, delky pole location
		\code
		if(empty($location)){
			$locationError = "Vacancy field is required";
			$res++;
		}else if(mb_strlen($location) > 35 ) {
			$locationError = "The length of location can have MAX 35 charachters";
			$res++;
		}else{
            $locationError = "";
		}
		\endcode

		d. Kontrola prazdnosti, delky pole involvement
		\code
		if(empty($involvement)){
			$involvementError = "Vacancy field is required";
			$res++;
		}else if(mb_strlen($involvement) > 35 ) {
			$involvementError = "The length of involvement can have MAX 35 charachters";
			$res++;
		}else{
            $involvementError = "";
		}
		\endcode

		e. Kontrola prazdnosti, delky vacancy description
		\code
		if(empty($vcdes)){
			$vcdesError = "Vacancy field is required";
			$res++;
		}else if(mb_strlen($vcdes) > 4000) {
			$vcdesError = "The length of vacancy description can have MAX 4000 charachters";
			$res++;
		}else{
            $vcdesError = "";
		}
		\endcode

	4.	Nahrani prispevku do DB, kdyz nedoslo k chybam
		\code
		if($res == 0){
			$mysql->query("INSERT INTO `jobs` (`vacancy`, `company`, `location`, `involvement`, `vcdes`) VALUES('$vacancy', '$company', '$location', '$involvement', '$vcdes')");
			$mysql->close();
			header('Location: ../index.php');
			exit();
		}
	}
		\endcode
	
	*/
?>