<?php
    // Nutne includy
    include "../functions/dbconnect.php";
    
    // Tento kod definuje dotazy na DB pro zjisteni existence nejakych dat.

    if(isset($_GET['username'])){
        //Dotaz na DB, exituje-li takovy username, ktery uzivatel napsal do pole username. Vystupem je pole 
        $username  = htmlspecialchars(filter_var(trim($_GET['username']), FILTER_SANITIZE_STRING));
        $result1 = $mysql->query("SELECT * FROM `users` WHERE `username` = '$username'");
        // Pokud ve promenne $result1  neco je, to znamena, ze uz existuje uzivatel s takovym username
        if(mysqli_num_rows($result1) != 0){
            echo "Username already exists";
        }else{
            echo "";
        }
    }
    // Podobne jako u username
    if(isset($_GET['email'])){
        $email  = htmlspecialchars(filter_var(trim($_GET['email']), FILTER_SANITIZE_STRING));
        $result2 = $mysql->query("SELECT * FROM `users` WHERE `email` = '$email'");
        if(mysqli_num_rows($result2) != 0){
            echo "Email already exists";
        }else{
            echo "";
        }
    }
    // Podobne jako u username
    if(isset($_GET['usernamelog'])){
        $login  = htmlspecialchars(filter_var(trim($_GET['usernamelog']), FILTER_SANITIZE_STRING));
        $result3 = $mysql->query("SELECT * FROM `users` WHERE `username` = '$login'");
        if(mysqli_num_rows($result3) == 0){
            echo "Username does not exist";
        }else{
            echo "";
        }
    }
    /*! \file

    Tento kod definuje dotazy na DB pro zjisteni existence nejakych dat.
    1.  Dotazy pri registraci

        Dotaz na DB, exituje-li takovy username, ktery uzivatel napsal do pole username. Vystupem je pole s udaji uzivatelu s podobnym username z inputu.
        \code
        if(isset($_GET['username'])){
        $username  = htmlspecialchars(filter_var(trim($_GET['username']), FILTER_SANITIZE_STRING));
        $result1 = $mysql->query("SELECT * FROM `users` WHERE `username` = '$username'");
        //Pokud ve promenne $result1  neco je, to znamena, ze uz existuje uzivatel s takovym username. Vratime chybu!
        if(mysqli_num_rows($result1) != 0){
            echo "Username already exists";
        }else{
            echo "";
        }
    }
        \endcode

        Stejnym zpusobem ostatni dotazy.
        \code
        // Podobne jako u username
        if(isset($_GET['email'])){
        $email  = htmlspecialchars(filter_var(trim($_GET['email']), FILTER_SANITIZE_STRING));
        $result2 = $mysql->query("SELECT * FROM `users` WHERE `email` = '$email'");
        if(mysqli_num_rows($result2) != 0){
            echo "Email already exists";
        }else{
            echo "";
        }
    }
        // Podobne jako u username
        if(isset($_GET['usernamelog'])){
            $login  = htmlspecialchars(filter_var(trim($_GET['usernamelog']), FILTER_SANITIZE_STRING));
            $result3 = $mysql->query("SELECT * FROM `users` WHERE `username` = '$login'");
            if(mysqli_num_rows($result3) == 0){
                echo "Username does not exist";
            }else{
                echo "";
            }
        }   
        \endcode
    */
?>