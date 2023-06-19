<?php
    /// Tato funkce vrati zpravu s max. id pro latest blog post na hlavni strance.
    // Vystupem je pole se vsemi udaji teto zpravy (nazev, misto uloziste obrazku atd.). 

    function getMaxId($link){
        $sql = "SELECT * FROM `postadmin` ORDER BY `id` DESC LIMIT 1";
        $sql = mysqli_query($link, $sql);
        $row = mysqli_fetch_assoc($sql);
        return $row;
    }
    
    
    
    
    
    
    
    
    /*! \file
    \param[$link] = odkaz pro pripojeni k DB. Nachazi se v dbconnect.php.
    
    \return Vrati pole se vsemi udaji teto zpravy (nazev, misto uloziste obrazku atd.)
    
    \code
    function getMaxId($link){
        $sql = "SELECT * FROM `postadmin` ORDER BY `id` DESC LIMIT 1";
        $sql = mysqli_query($link, $sql);
        $row = mysqli_fetch_assoc($sql);
        return $row;
    }
    \endcode
    
    
    
    
    
    
    
    
    
    
    
    */
?>
