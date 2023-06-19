<?php
    /// Tato funkce vrati vse, co je v DB v tabuli postadmin pro blog
    // Vrati jeden zaznam vzorku jako asociativni pole
    // Hodnoty poli jsou take umisteny v prvcich pole. Nazvy prvku se shoduji s nazvy poli.
    function get_dataPost($link) { 
        $db = "SELECT * FROM `postadmin`";
        $res = mysqli_query($link, $db);
        // Parametr MYSQLI_ASSOC - asociativni pole
        $posts = mysqli_fetch_all($res, MYSQLI_ASSOC);
        return $posts;
    }
    
    
    
    
    
    
    
    
    /*! \file
    \param[$link] = odkaz pro pripojeni k DB. Nachazi se v dbconnect.php.

    \return  Vrati jeden zaznam vzorku jako asociativni pole.  Hodnoty poli jsou take umisteny v prvcich pole. Nazvy prvku se shoduji s nazvy poli.

    \code
    function get_dataPost($link) {
        $db = "SELECT * FROM `postadmin`";
        $res = mysqli_query($link, $db);
        // Parametr MYSQLI_ASSOC - asociativni pole
        $posts = mysqli_fetch_all($res, MYSQLI_ASSOC);
        return $posts;
    }
    \endcode
    */
?>