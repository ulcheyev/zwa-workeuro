<?php 
    /// Tato funkce bere id prispevku (zprava) jako parametr a pak ten prispevek najde v DB. 
    // Vystupem je pole se vsemi udaji tohoto prispevku.
    // Vrati jeden zaznam vzorku jako asociativni pole.
    // Hodnoty poli jsou take umisteny v prvcich pole. 
    // Nazvy prvku se shoduji s nazvy poli.
    function get_news_by_id(
        $post_id, ///< GET parametr. id stranky se zpravou.
        $link    ///< Odkaz pro pripojeni k DB. Nachazi se v dbconnect.php.
        ){      /// \return Vrati jeden zaznam vzorku jako asociativni pole. Hodnoty poli jsou take umisteny v prvcich pole. Nazvy prvku se shoduji s nazvy poli.
    
        $sql = "SELECT * FROM `postadmin` WHERE `id` =  ".$post_id;
        $result2 = mysqli_query($link, $sql);
        $post = mysqli_fetch_assoc($result2);
        return $post;

        }
    /*! \file
    Tato funkce bere id prispevku (zprava) jako parametr a pak ten prispevek najde v DB. 
    \code
    function get_news_by_id($post_id, $link){
        $sql = "SELECT * FROM `postadmin` WHERE `id` =  ".$post_id;
        $result2 = mysqli_query($link, $sql);
        $post = mysqli_fetch_assoc($result2);
        return $post;
    \endcode
    
    
    
    */
?>