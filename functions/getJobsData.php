<?php 
    /// Tato fuknce vrati cely seznam praci pro zobrazeni na hlavni strance
    // Vrati jeden zaznam vzorku jako asociativni pole
    // Hodnoty poli jsou take umisteny v prvcich pole. Nazvy prvku se shoduji s nazvy poli.
    function get_data($link) {
        $sql = "SELECT * FROM `jobs` ORDER BY `id` DESC ";
        $result = mysqli_query($link, $sql);
        // Parametr MYSQLI_ASSOC - asociativni pole
        $jobs = mysqli_fetch_all($result, MYSQLI_ASSOC);
        return $jobs;
    }

    /*! \file
    \param[$link] = odkaz pro pripojeni k DB. Nachazi se v dbconnect.php.

    \return  Vrati jeden zaznam vzorku jako asociativni pole.  Hodnoty poli jsou take umisteny v prvcich pole. Nazvy prvku se shoduji s nazvy poli.

    \code
    function get_data($link) {
        $sql = "SELECT * FROM `jobs` ORDER BY `id` DESC ";
        $result = mysqli_query($link, $sql);
        // Parametr MYSQLI_ASSOC - asociativni pole
        $jobs = mysqli_fetch_all($result, MYSQLI_ASSOC);
        return $jobs;
    }
    \endcode
    
    
    */
?>

