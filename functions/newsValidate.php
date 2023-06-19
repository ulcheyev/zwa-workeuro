<?php
    // Kod kontroluje policky formulare pro blog post a zapisuje to do DB.
	if(isset($_POST['post'])){
		$res = 0;
		$title = trim(mysqli_real_escape_string($mysql, $_POST['title']));
		$text = trim(mysqli_real_escape_string($mysql, $_POST['newstext']));

		// Chyby pro zobrazeni
		$titleError = $textError = $imageError = "";

		// Validace
		// Validace title
		if(empty($title)){
			$titleError = "Title is required";
			$res++;
		}else if(mb_strlen(stripslashes($title))  > 124) {
			$titleError = "The length of title can have MAX 125 charachters";
			$res++;
		}else{
            $titleError = "";
		}
		//Validace text
		if(empty($text)){
			$textError = "News text is required";
			$res++;
		}else if(mb_strlen(stripslashes($text))  > 4000) {
			$textError = "The length of news text can have MAX 4000 charachters";
			$res++;
		}else{
            $textError = "";
		}

		// Validace image
		if($_FILES['image']['name']){
			$name = $_FILES['image']['name'];
			$tmp_name = $_FILES['image']['tmp_name'];
			$path = "Images/" .time() .$name;
			move_uploaded_file($tmp_name, $path);

		}else{
			$imageError= "Image is required";
			$res++;
		}
        // Pokud nedoslo k chybam, zprava se zapise do DB
		if($res==0){
			$mysql->query("INSERT INTO `postadmin` (`title`, `text`, `image`) VALUES('$title', '$text', '$path')");
			$mysql->close();
			header('Location: ../blog/blog.php');
			exit();
		}
	}
	/*! \file
	Kod kontroluje policky formulare pro blog post a zapisuje to do DB.
	1.	Pokud admin stiskl tlacitko Post news, vsechna odeslana data se zapisou do promennych.
		Promenna $res slouzi ke kontrole chyb, puvodni hodnota je 0. Pokud se pri vyplnovani formulare objevi chyba, tato promenna se zvysi o 1. 
	   	Vyplneni formulare je uspesne pouze tehdy, je-li tato promenna se rovna 0.
		\code
	if(isset($_POST['post'])){
		$res = 0;
		$title = trim(mysqli_real_escape_string($mysql, $_POST['title']));
		$text = trim(mysqli_real_escape_string($mysql, $_POST['newstext']));
		\endcode

	2.	Chyby pro zobrazeni
		\code
		$titleError = $textError = $imageError = "";
		\endcode
	
	3.	Validace. Nastaveni chyb.

		a. Validace prazdnosti, delky title.
		\code
		if(empty($title)){
			$titleError = "Title is required";
			$res++;
		}else if(mb_strlen($title)  > 124) {
			$titleError = "The length of title can have MAX 125 charachters";
			$res++;
		}else{
            $titleError = "";
		}
		b. Validace prazdnosti, delky text
		if(empty($text)){
			$textError = "News text is required";
			$res++;
		}else if(mb_strlen($text)  > 4000) {
			$textError = "The length of news text can have MAX 4000 charachters";
			$res++;
		}else{
            $textError = "";
		}
		\endcode

		c. Validace prazdnosti image.
		\code
		if($_FILES['image']['name']){
			$name = $_FILES['image']['name'];
			$tmp_name = $_FILES['image']['tmp_name'];
			$path = "Images/" .time() .$name;
			move_uploaded_file($tmp_name, $path);

		}else{
			$imageError= "Image is required";
			$res++;
		}
		\endcode

    4.	Pokud nedoslo k chybam, zprava se zapise do DB
		\code
		if($res==0){
			$mysql->query("INSERT INTO `postadmin` (`title`, `text`, `image`) VALUES('$title', '$text', '$path')");
			$mysql->close();
			header('Location: ../blog/blog.php');
			exit();
		}
	}
		\endcode
	*/
?>