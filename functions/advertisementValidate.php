<?php
	//Tento kod kontroluje policky v forlumari pro zajemce o praci a pak zapise do DB toho zajemce. 
	
	$post = get_post_by_id($post_id, $mysql); ///< Ziskani data prispevku pro zobrazeni.

	if(isset($_POST['apply'])){
		$res = 0;
		$firstname1 = trim(mysqli_real_escape_string($mysql, $_POST['firstname']));;
		$lastname1 =  trim(mysqli_real_escape_string($mysql, $_POST['lastname']));
		$phone= trim(mysqli_real_escape_string($mysql, $_POST['phone']));
		$position=trim(mysqli_real_escape_string($mysql, $_POST['positiondb']))." id= ".$post_id;
		$positionidindb=trim(mysqli_real_escape_string($mysql, $_POST['positionidindb']));

		// Chyby pro zobrazeni
		$firstnameError = $lastnameError = $phoneError = "";

		// Validace firstname
		if(empty($firstname1)){
			$firstnameError = "First name is required";
			$res++;
		}else if(!preg_match("/^[a-zA-Z]*$/", $firstname1 )){
			$firstnameError = "Firstname can contain only letters";
            $res++;
		}else{
			$firstnameError="";
		}

		// Validace lastname
		if(empty($lastname1)){
			$lastnameError = "Last name is required";
			$res++;
		}else if(!preg_match("/^[a-zA-Z]*$/", $firstname1 )){
			$lastnameError = "Lastname can contain only letters";
            $res++;
		}else{
			$lastnameError = "";
		}

		// Valdace phone
		if(empty($phone)){
			$phoneError = "Phone is required";
			$res++;
		}else if(!preg_match("/^[+]\(?([0-9]{3})\)?[-. ]?([0-9]{3})[-. ]?([0-9]{3})[-. ]?([0-9]{3})$/", $phone)){
			$phoneError = "Invalid phone number";
			$res++;
		}else{
			$phoneError = "";
		}
        // Pokud nedoslo k chybam, zajemse se zapise do DB				
		if($res == 0){
			$mysql->query("INSERT INTO `interested` (`job`, `firstname`, `lastname`, `phone`) VALUES('$position','$firstname1', '$lastname1', '$phone')");
			$mysql->close();
			$error['success'] = "You will be contacted";
			$post_id = $positionidindb;
		}

	}
	/*! \file
	Tento kod kontroluje policky v forlumari pro zajemce o praci a pak zapise do DB toho zajemce. 
	1.  Ziskani data prispevku pro zobrazeni.
	\code
	$post = get_post_by_id($post_id, $mysql);
	\endcode

	2. Pokud uzivatel stiskl tlacitko Apply, vsechna odeslana data se zapisou do promennych.
	   Promenna $res slouzi ke kontrole chyb, puvodni hodnota je 0. Pokud se pri vyplnovani formulare objevi chyba, tato promenna se zvysi o 1. 
	   Vyplneni formulare je uspesne pouze tehdy, je-li tato promenna se rovna 0.
	\code
	if(isset($_POST['apply'])){
		$res = 0;
		$firstname1 = trim(mysqli_real_escape_string($mysql, $_POST['firstname']));;
		$lastname1 =  trim(mysqli_real_escape_string($mysql, $_POST['lastname']));
		$phone= trim(mysqli_real_escape_string($mysql, $_POST['phone']));
		$position=trim(mysqli_real_escape_string($mysql, $_POST['positiondb']))." id= ".$post_id;
		$positionidindb=trim(mysqli_real_escape_string($mysql, $_POST['positionidindb']));
	\endcode
	3. Chyby pro zobrazeni.
		\code
		$firstnameError = $lastnameError = $phoneError = "";
		\endcode
	4. Validace vstupních polí. Nastaveni chyb.

	   a. Validace firstname.
	   Kontrola poli na prazdnotu a na shodu s regulernim vyrazem.
		\code
		if(empty($firstname1)){
			$firstnameError = "First name is required";
			$res++;
		}else if(!preg_match("/^[a-zA-Z]*$/", $firstname1 )){
			$firstnameError = "Firstname can contain only letters";
            $res++;
		}else{
			$firstnameError="";
		}
		\endcode

		
		b. Validace lastname.
		Kontrola poli na prazdnotu a na shodu s regulernim vyrazem.
		\code
		if(empty($lastname1)){
			$lastnameError = "Last name is required";
			$res++;
		}else if(!preg_match("/^[a-zA-Z]*$/", $firstname1 )){
			$lastnameError = "Lastname can contain only letters";
            $res++;
		}else{
			$lastnameError = "";
		}
		\endcode

		c. Validace phone.
		Kontrola poli na prazdnotu a na shodu s regulernim vyrazem.
		\code
		if(empty($phone)){
			$phoneError = "Phone is required";
			$res++;
		}else if(!preg_match("/^[+]\(?([0-9]{3})\)?[-. ]?([0-9]{3})[-. ]?([0-9]{3})[-. ]?([0-9]{3})$/", $phone)){
			$phoneError = "Invalid phone number";
			$res++;
		}else{
			$phoneError = "";
		}
		\endcode

    5.  Pokud nedoslo k chybam, zajemse se zapise do DB.
		\code			
		if($res == 0){
			$mysql->query("INSERT INTO `interested` (`job`, `firstname`, `lastname`, `phone`) VALUES('$position','$firstname1', '$lastname1', '$phone')");
			$mysql->close();
			$error['success'] = "You will be contacted";
			$post_id = $positionidindb;
		}
	}
		\endcode
		
	*/	
?>