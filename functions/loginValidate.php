<?php 
    if(isset($_POST['login'])){
        $login = trim(mysqli_real_escape_string($mysql, $_POST['usernamelog']));
        $password = trim(mysqli_real_escape_string($mysql, $_POST['password']));
        $res = 0; // Promenna pro kontrolu chyb. Kazda chyba pridava 1.
        $usernameError =  $passwordError = ""; // Chyby pro zobrazeni.
        
        // Kontrola username
        if(empty($login)){
            $usernameError ="Username is reqiured";
            $res++;
        }else{
            // DB. Kontrola existance uzivatele s napsanym username
            $result = $mysql->query("SELECT * FROM `users` WHERE `username` = '$login'");
            $user = $result->fetch_assoc();
            if($user == 0) {
                $usernameError = "A user with this username was not found";
                $res++;
            }else{
                $usernameError = "";
            }
        }

        // Kontrola password
        if(empty($password)){
            $passwordError = "Password id required";
            $res++;
        }else{
            $passwordError = "";
        }
        
        // Pokud takovy uzivatel existuje a nedoslo k chybam, =>
        // kontola hesla pomoci pasword_verify a autorizace.
        if($res==0){
            if(password_verify($password, $user['password'])) {
                $_SESSION['success'] = "";
                $_SESSION['username'] = $login;
                $mysql->close();
                header('Location: ../index.php');
                exit();
            }else{
                $passwordError = "Wrong password";
            }	
        }
    }
    /*! \file
    Tento kod zkontroluje policky v prihlasovacim formulare a autorizuje uzivatele.
    1.  Pokud uzivatel stiskl tlacitko Initialize, vsechna odeslana data se zapisou do promennych.
    \code
    if(isset($_POST['login'])){
        $login = trim(mysqli_real_escape_string($mysql, $_POST['usernamelog']));
        $password = trim(mysqli_real_escape_string($mysql, $_POST['password']));
    \endcode

    2.  Promenne pro chyby a pro jejich kontrolu.

        a. Promenna pro kontrolu chyb. Kazda chyba pridava 1.
    \code
    $res = 0;
    \endcode
        b. Chyby pro zobrazeni. 
    \code 
    $usernameError =  $passwordError = ""; 
    \endcode

    3.  Validace vstupnich poli. Nastaveni chyb.

        a. Kontrola username. Kontrola prazdnosti pole a existance uzivatele.
    \code
    if(empty($login)){
        $usernameError ="Username is reqiured";
        $res++;
    }else{
    //Kontrola existance uzivatele s takovym username, ktery uzivatel zadal do pole. 
    //Dotaz na DB. Pokud takovy uzivatel neexistuje  =>pridat chybu.

        $result = $mysql->query("SELECT * FROM `users` WHERE `username` = '$login'");
        $user = $result->fetch_assoc();
        if($user == 0) {
            $usernameError = "A user with this username was not found";
            $res++;
        }else{
            $usernameError = "";
        }
    }
    \endcode
        b. Kontrola password
    \code
    if(empty($password)){
        $passwordError = "Password id required";
        $res++;
    }else{
        $passwordError = "";
    }
    \endcode

    4.  Pokud takovy uzivatel existuje a nedoslo k chybam =>
        kontola hesla pomoci pasword_verify a autorizace.
        V opacnem pripade zobrazit chybu.
    \code
    if($res==0){
        if(password_verify($password, $user['password'])) {
            $_SESSION['success'] = "";
            $_SESSION['username'] = $login;
            $mysql->close();
            header('Location: ../index.php');
            exit();
        }else{
            $passwordError = "Wrong password";
        }	
    }
    }
    \endcode
    */
?>