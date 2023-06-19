<?php 
    /// Kontrola tokenu uzivatele s vytvorenym tokenem pro SESSION. 
    if(isset($_POST['csrf_token'])){
        if($_POST['csrf_token'] != $_SESSION['csrf_token']){
            header('Location: ../errors/csrf-token-error.php');
            exit();
        }
    }else{
        if(isset($_GET['csrf_token'])){
        if($_GET['csrf_token'] != $_SESSION['csrf_token']){
           header('Location: errors/csrf-token-error.php');
           exit();
        }
    }
}
    // Vytvoreni unikatniho tokenu a nastaveni tohoto tokenu do SESSION pro validaci pri posilani formulare.
    $token = md5(uniqid(rand(),true));
    $_SESSION['csrf_token'] = $token; ///< nastaveni tokenu pro odolnost dvojitemu odesilani formulare
    
    
    
    
    /*! \file
    Kontrola nastaveni tikenu. Na webu jsou dva typy formulare. Jeden posila data Get, ostatni Post.
    Pokud se generovany token neshoduje s SESSION tokenem => presmerovani na stranku s chybou.
    \code
    if(isset($_POST['csrf_token'])){
        if($_POST['csrf_token'] != $_SESSION['csrf_token']){
            header('Location: ../errors/csrf-token-error.php');
            exit();
        }
    }else{
        if(isset($_GET['csrf_token'])){
        if($_GET['csrf_token'] != $_SESSION['csrf_token']){
            header('Location: ../index.php');
            exit();
        }
    }
    \endcode

    Vytvoreni unikatniho tokenu a nastaveni tohoto tokenu do SESSION pro validaci pri posilani formulare.
    \code
    $token = md5(uniqid(rand(),true));
    $_SESSION['csrf_token'] = $token;
    \endcode
}
    
    
    
    
    
    */
?>