<?php
    //Tato cast kodu je zodpovedna za strankovani a zobrazeni prace.
    $countView = 9; ///<Celkovy pocet polozek k zobrazeni.
	if(isset($_GET['page'])){
		$pageNum = (int)$_GET['page'];
	}else{
		$pageNum = 1; ///< Nastaveni cisla stranky.
	}
	$startIndex = ($pageNum-1)*$countView;///<Vypocet uvodni stranky.
	$result = $mysql->query("SELECT * FROM `postadmin` ORDER BY `id` DESC LIMIT $startIndex,$countView"); ///< Dotaz a ziskani data pro blog.
	$newsData = array(); ///< Pole, do ktereho se pridavaji hodnoty z dotazu pro blog.
	while($row = $result->fetch_assoc()){
		$newsData[] = $row;
	}
	$sql2 = $mysql->query("SELECT count(*) FROM `postadmin`"); ///< Dotaz ziskani celkoveho poctu polozek v tabuli pro blog.
	$row = $sql2->fetch_row(); ///< Pole, v kterem je cislo celkoveho poctu polozek.
	$lastPage = ceil($row[0]/$countView);///<Vypocet posledni stranky.
    
    /*! \file
    Tato cast kodu je zodpovedna za strankovani a zobrazeni prace.

    Celkovy pocet polozek k zobrazeni.
    \code
    $countView = 8; 
    \endcode

    Kontrola existence aktualni stranky.
    \code
	if(isset($_GET['page'])){
		$pageNum = (int)$_GET['page'];
	}else{
		$pageNum = 1;
	}
    \endcode

    Vypocet uvodni stranky.
    \code
	$startIndex = ($pageNum-1)*$countView;
    \endcode

    Dotaz pro ziskani polozek omezenych promennami $startIndex a $countView. Ulozeni data do pole.
    \code
	$result = $mysql->query("SELECT * FROM `postadmin` ORDER BY `id` DESC LIMIT $startIndex,$countView");
	$newsData = array();
	while($row = $result->fetch_assoc()){
		$newsData[] = $row;
	}
    \endcode

    Ziskani celkoveho poctu polozek v tabuli. Vypocet posledni stranky.
    \code
	$sql2 = $mysql->query("SELECT count(*) FROM `postadmin`");
	$row = $sql2->fetch_row();
	$lastPage = ceil($row[0]/$countView);
    \endcode
    
    
    */
?>