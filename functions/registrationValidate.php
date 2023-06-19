<?php
    // Tento kod zkontroluje policky a zaregistruje uzivatel
    
    if(isset($_POST['register'])){
        $usernamereg = trim(mysqli_real_escape_string($mysql, $_POST['username']));
		$email = trim(mysqli_real_escape_string($mysql, $_POST['email']));
		$passwordreg1 = trim(mysqli_real_escape_string($mysql, $_POST['password']));
		$passwordregconfirm = trim(mysqli_real_escape_string($mysql, $_POST['confirmpassword']));

        
        $res = 0; // Promenna pro kontrolu chyb. Kazda chyba pridava 1.
        $usernameError = $emailError = $passwordError = $passwordConfirmError = ""; // Chyby pro zobrazeni.
        //Validace, Databaze

        // Dotaz k DB pro zjisteni existence username a email.
        $result4 = $mysql->query("SELECT * FROM `users` WHERE `username` = '$usernamereg'");
        $result5 = $mysql->query("SELECT * FROM `users` WHERE `email` = '$email'");
        $user = mysqli_num_rows($result4);
        $emailcheck = mysqli_num_rows($result5);

        // Validace username
        if (empty($usernamereg)) {
            $usernameError = "Username is required";
            $res++;
        }else if (!preg_match("/^[a-zA-Z0-9]*$/", $usernamereg)){
            $usernameError = "Username can contain only letters and numbers";
            $res++;
        }else if($user > 0) {
            $usernameError = "Username already exists";
            $res++;
        }else if(mb_strlen($usernamereg) < 3 || mb_strlen($usernamereg) > 15) {
            $usernameError = "Invalid username length. Min 3, Max 15";
            $res++;
        }else{
            $usernameError = "";
        }
        // Validace email
        if (empty($email)){
            $emailError = "Email is required";
            $res++;
        }else if ($emailcheck>0) {
            $emailError = "Email already exists";
            $res++;
        }else if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
            $emailError = "Invalid email";
            $res++;
        }else{
            $emailError = "";
        
        
        // Password validace
        }if (empty($passwordreg1)){
            $passwordError = "Password is required";
            $res++;
        }else if ($passwordreg1 !== $passwordregconfirm) {
            $passwordError = "Passwords must match";
            $passwordConfirmError = "Passwords must match";
            $res++;
        }else  if(mb_strlen($passwordreg1) < 8) {
             $passwordError = "Password must contain MIN 8 charachters";
             $res++;
        }else{
            $passwordError = "";

        
        
        }if (empty($passwordregconfirm)){
            $passwordConfirmError = "Password confirm is required";
            $res++;
        }else{
            $passwordConfirmError = "";
        

        // Registrace uzivatele, kdyz nedoslo k chybam
        // Hasovani a osoleni hesla pomoci password_hash
        }if ($res == 0) {
            $_SESSION['success'] = "yes";
            $usernameError = $emailError = $passwordError = $passwordConfirmError = "";
            $passwordreg = password_hash($passwordreg1, PASSWORD_DEFAULT);
            $mysql->query("INSERT INTO `users` (`username`, `email`, `password`) VALUES('$usernamereg', '$email', '$passwordreg')");
            $mysql->close();
            header('Location: ../registration/login.php');
            exit();
        }
	}
    /*! \file
    Tento kod zkontroluje policky a zaregistruje uzivatele
    1.  Pokud uzivatel stiskl tlacitko Get Started, vsechna odeslana data se zapisou do promennych.
    \code
    if(isset($_POST['register'])){
        $usernamereg = trim(mysqli_real_escape_string($mysql, $_POST['username']));
		$email = trim(mysqli_real_escape_string($mysql, $_POST['email']));
		$passwordreg1 = trim(mysqli_real_escape_string($mysql, $_POST['password']));
		$passwordregconfirm = trim(mysqli_real_escape_string($mysql, $_POST['confirmpassword']));
    \endcode

    2.  Promenne pro chyby a pro jejich kontrolu.

        a. Promenna pro kontrolu chyb. Kazda chyba pridava 1.
    \code
        $res = 0;
     \endcode
        b. Chyby pro zobrazeni.
    \code
        $usernameError = $emailError = $passwordError = $passwordConfirmError = ""; // Chyby pro zobrazeni.
    \endcode    
    3.  Validace, Databaze. Nastaveni chyb.

        Dotaz k DB pro zjisteni existence username a email, zadanych uzivatelem.
        \code
        $result4 = $mysql->query("SELECT * FROM `users` WHERE `username` = '$usernamereg'");
        $result5 = $mysql->query("SELECT * FROM `users` WHERE `email` = '$email'");
        $user = mysqli_num_rows($result4);
        $emailcheck = mysqli_num_rows($result5);
        \endcode    

        a. Validace prazdnosti, delky username a shody s regulernim vyrazem.
        \code
        if (empty($usernamereg)) {
            $usernameError = "Username is required";
            $res++;
        }else if (!preg_match("/^[a-zA-Z0-9]*$/", $usernamereg)){
            $usernameError = "Username can contain only letters and numbers";
            $res++;
        }else if ($user > 0) {
            $usernameError = "Username already exists";
            $res++;
        }else if(mb_strlen($usernamereg) < 3 || mb_strlen($usernamereg) > 15) {
            $usernameError = "Invalid username length. Min 3, Max 15";
            $res++;
        }else{
            $usernameError = "";
        }
        \endcode

        b. Validace prazdnosti email a shody s regulernim vyrazem.
        \code
        if (empty($email)){
            $emailError = "Email is required";
            $res++;
        }else if ($emailcheck>0) {
            $emailError = "Email already exists";
            $res++;
        }else if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
            $emailError = "Invalid email";
            $res++;
        }else{
            $emailError = "";
        }
        \endcode
        
        c. Validace prazdnosti, delky password.
        \code
        }if (empty($passwordreg1)){
            $passwordError = "Password is required";
            $res++;
        }else if ($passwordreg1 !== $passwordregconfirm) {
            $passwordError = "Passwords must match";
            $passwordConfirmError = "Passwords must match";
            $res++;
        }else  if(mb_strlen($passwordreg1) < 8) {
             $passwordError = "Password must contain MIN 8 charachters";
             $res++;
        }else{
            $passwordError = "";
        }
        \endcode 

        d. Validace password_confirm
        \code
        }if (empty($passwordregconfirm)){
            $passwordConfirmError = "Password confirm is required";
            $res++;
        }else{
            $passwordConfirmError = "";
        }
        \endcode 

    4.  Registrace uzivatele, kdyz nedoslo k chybam.
        Hasovani a osoleni hesla pomoci password_hash.
        Zapis udaju do DB.
        $_SESSION['success'] = "yes" je potreba pro zobrazeni oznameni v prihlasovacim formulare, ze registrace je uspesna.
        \code
        }if ($res == 0) {
            $_SESSION['success'] = "yes";
            $usernameError = $emailError = $passwordError = $passwordConfirmError = "";
            $passwordreg = password_hash($passwordreg1, PASSWORD_DEFAULT);
            $mysql->query("INSERT INTO `users` (`username`, `email`, `password`) VALUES('$usernamereg', '$email', '$passwordreg')");
            $mysql->close();
            header('Location: ../registration/login.php');
            exit();
        }
	}
        \endcode 
    */
?>