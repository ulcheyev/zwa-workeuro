<?php

    //Tento kod pripojuje DB a ukazuje na chyby s pripojeni, pokud jsou.

    // Data login DB.
    //$HOST = "remotemysql.com"; ///< Jmeno hostu pro pripojeni k DB.
    //$USER = "dv9MEXW4Cs"; ///< Jmeno usera pro pripojeni k DB.
    //$PASS = "jGoywkn0ma"; ///< Heslo pro pripojeni k DB.
    //$TABLE = "dv9MEXW4Cs"; ///< Nazev tabule pro pripojeni k DB.
    
    // WA.TOAD
     $HOST = "localhost";///< Jmeno hostu pro pripojeni k DB.
     $USER = "ulcheyev"; ///< Jmeno usera pro pripojeni k DB.
     $PASS = "webove aplikace";///< Heslo pro pripojeni k DB.
     $TABLE = "ulcheyev"; ///< Nazev tabule pro pripojeni k DB.


    // Connect 
    $mysql = mysqli_connect($HOST, $USER, $PASS, $TABLE); 
    
    // Zobrazeni chyb pri pripojeni k DB.
    if(mysqli_connect_errno()) {
        header("Location: ../errors/dbconnect-error.php");
        mysqli_close($mysql);
        exit();
    }

    // Vyrobit session
    session_start();
    
    /*! \file
    1. Connect 
    \code
    $mysql = mysqli_connect($HOST, $USER, $PASS, $TABLE); 
    \endcode

    2. Zobrazeni chyb pri pripojeni k DB.
    \code
    if(mysqli_connect_errno()) {
        header("Location: ../errors/dbconnect-error.html"); 
        exit();
    }
    \endcode
    */
?>