<?php 
    
    //Kontrola nastaveni post id.   
    if(isset($_POST['positionidindb'])){
		$post_id = $_POST['positionidindb'];
	}else{
		$post_id = $_GET['post_id']; ///< Nastaveni id z GET pole.
	}
    /// Tato funkce bere id prispevku (prace) jako parametr a pak ten prispevek najde v DB. 
    // Vystupem je pole se vsemi udaji (datum nahrani, nazev prace atd.) tohoto prispevku.
    function get_post_by_id(
        $post_id,  ///< GET parametr. id stranky s praci.
        $link     ///< Odkaz pro pripojeni k DB. Nachazi se v dbconnect.php.
        ){       /// \return  Vystupem je pole se vsemi udaji (datum nahrani, nazev prace atd.) tohoto prispevku.
        $sql = "SELECT * FROM `jobs` WHERE `id` =  ".$post_id;
        $result2 = mysqli_query($link, $sql);
        $post = mysqli_fetch_assoc($result2);
        return $post;
    }



    /*! \file

    Kontrola nastaveni post id.
    Po vyplneni formulare Apply now ztrati se GET parametr post_id.
    Po odesilani formulare parametr get_id prijima hodnotu positionindb (hidden input v formulari).
    \code   
    if(isset($_POST['positionidindb'])){
		$post_id = $_POST['positionidindb'];
	}else{
		$post_id = $_GET['post_id'];
	}
    \endcode

    Funkce
    \code
    function get_post_by_id($post_id, $link){
        $sql = "SELECT * FROM `jobs` WHERE `id` =  ".$post_id;
        $result2 = mysqli_query($link, $sql);
        $post = mysqli_fetch_assoc($result2);
        return $post;
    \endcode
    
    
    
    
    */
?>
        