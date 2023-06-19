<?php
	//Tato cast kodu je zodpovedna za strankovani a zobrazeni prace.

	
	$countView = 10; ///<Celkovy pocet polozek k zobrazeni.
	
	//Kontrola existence aktualni stranky.
	if(isset($_GET['page'])){
		$pageNum = (int)$_GET['page'];
	}else{
		$pageNum = 1;
	}

	$startIndex = ($pageNum-1)*$countView; ///<Vypocet uvodni stranky.

	///Funkce najde v databazi podobne polozky, ktere jsou nastaveny parametry.(1 input)
	function getData(
		$mysql,     ///< Odkaz pro pripojeni k DB. Nachazi se v dbconnect.php.
		$trigger,  ///< Nazev inputu; Vacancy nebo Company. Tyto inputy urcujou, odkud bude vyber.
		$data     ///< Data z inputu. Urcuji, co je nutne vybrat.
		){       /// \return Vrati pole s prvky(prace), u kterych nastaveny parametr(vacancy, company) je podobny jako input.
		global $countView, $startIndex;
		//Dotaz do db, vyber urcitych radku z tabulky nastavene pomoci promennych startidex ,countview a ktere jsou podobne inputu.
		$result = $mysql->query("SELECT * FROM `jobs` WHERE `$trigger` LIKE '%$data%'  ORDER BY `id` DESC LIMIT $startIndex,$countView");
		//Vytvoreni associativniho pole.
		$newsData = array();
		while($row = $result->fetch_assoc()){
			$newsData[] = $row;
		}
		return $newsData;
	}
	//Pokud dva inputy
	// Vystupem je pole  s udaji o kazde praci.
	///Funkce najde v databazi podobne polozky, ktere jsou nastaveny parametry.(2 inputy)
	function getData2(
		$mysql,       ///< Odkaz pro pripojeni k DB. Nachazi se v dbconnect.php.
		$trigger1,   ///< Nazev 1 inputu; Vacancy nebo Company. Tyto inputy urcujou, odkud bude vyber.
		$trigger2,  ///< Nazev 2 inputu; Vacancy nebo Company. Tyto inputy urcujou, odkud bude vyber.     
		$data1,    ///< Data z 1 inputu. Urcuji, co je nutne vybrat.
		$data2    ///< Data z 2 inputu. Urcuji, co je nutne vybrat.
		){       /// \return Vrati pole s prvky(prace), u kterych nastavene parametry(vacancy, company) jsou podobne jako inputy.
		global $countView, $startIndex;
		//Dotaz do db, vyber urcitych radku z tabulky nastavene pomoci promennych startidex ,countview a ktere jsou podobne inputu.
		//Tady je nutne vybirat z polozek dannych druhym inputem.
		$result = $mysql->query("SELECT * FROM (SELECT * FROM `jobs` WHERE $trigger2 LIKE '%$data2%') AS job WHERE $trigger1 LIKE '%$data1%' ORDER BY id DESC LIMIT $startIndex,$countView");
		//Vytvoreni associativniho pole.
		$newsData = array();
		while($row = $result->fetch_assoc()){
			$newsData[] = $row;
		}
		return $newsData;
	}

	//Pokud nic nebylo zadano - vratit vsechno z tabule pro zobrazeni prace
	// Vystupem je pole 
	///Funkce vraci vsechny polozky z tabule
	function getDataAll(
		$mysql ///< Odkaz pro pripojeni k DB. Nachazi se v dbconnect.php.
		){	  /// \return Funkce vraci vsechny polozky z tabule.
		global $countView, $startIndex;
		$result = $mysql->query("SELECT * FROM `jobs` ORDER BY `id` DESC LIMIT $startIndex,$countView");
		$newsData = array();
		while($row = $result->fetch_assoc()){
			$newsData[] = $row;
		}
		return $newsData;
	}

	/// Fukce spocita cislo posledni stranky pro vypocet strankovani, kdyz jsou dva inputy.
	// Vystupem je cislo posledni stranky.
	function numOfRowsGetData2(
		$mysql,       ///< Odkaz pro pripojeni k DB. Nachazi se v dbconnect.php.
		$trigger1,   ///< Nazev 1 inputu; Vacancy nebo Company. Tyto inputy urcujou, odkud bude vyber.
		$trigger2,  ///< Nazev 2 inputu; Vacancy nebo Company. Tyto inputy urcujou, odkud bude vyber.     
		$data1,    ///< Data z 1 inputu. Urcuji, co je nutne vybrat.
		$data2    ///< Data z 2 inputu. Urcuji, co je nutne vybrat.
		) {       /// \return Vrati cislo posledni stranky pri zanadych 2 inputech.
		global $countView, $startIndex;
		$result = $mysql->query("SELECT * FROM (SELECT * FROM `jobs` WHERE $trigger2 LIKE '%$data2%') AS job WHERE $trigger1 LIKE '%$data1%'");
		$row = $result->num_rows;
        $lastPage = ceil($row/$countView);
		return $lastPage;
	}
    

	/*! \file
	Tato cast kodu je zodpovedna za strankovani a zobrazeni prace.

	Celkovy pocet polozek k zobrazeni.
	\code
	$countView = 10;
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
	
	Funkce najde v databazi podobne polozky, ktere jsou nastaveny parametry.
	\code
	function getData($mysql, $trigger, $data){
		global $countView, $startIndex;
		//Dotaz do db, vyber urcitych radku z tabulky nastavene pomoci promennych startidex ,countview a ktere jsou podobne inputu.
		$result = $mysql->query("SELECT * FROM `jobs` WHERE `$trigger` LIKE '%$data%'  ORDER BY `id` DESC LIMIT $startIndex,$countView");
		//Vytvoreni associativniho pole.
		$newsData = array();
		while($row = $result->fetch_assoc()){
			$newsData[] = $row;
		}
		return $newsData;
	}
	\endcode

	Tato funkcem je urcena pro to, kdyz jsou nastaveny dva inputy. Tady je treba hledat pres vnoreni.
	\code
	function getData2($mysql, $trigger1, $trigger2, $data1, $data2){
		global $countView, $startIndex;
		//Dotaz do db, vyber urcitych radku z tabulky nastavene pomoci promennych startidex ,countview a ktere jsou podobne inputu.
		//Tady je nutne vybirat z polozek dannych druhym inputem.
		$result = $mysql->query("SELECT * FROM (SELECT * FROM `jobs` WHERE $trigger2 LIKE '%$data2%') AS job WHERE $trigger1 LIKE '%$data1%' ORDER BY id DESC LIMIT $startIndex,$countView");
		//Vytvoreni associativniho pole.
		$newsData = array();
		while($row = $result->fetch_assoc()){
			$newsData[] = $row;
		}
		return $newsData;
	}
	\endcode

	Fukce spocita cislo posledni stranky pro vypocet strankovani, kdyz jsou dva inputy.
	Vybere všechny položky podobné dvěma inputy současně a pak spocita pocet radku.
	\code
	function numOfRowsGetData2($mysql, $trigger1, $trigger2, $data1, $data2) {
		global $countView, $startIndex;
		$result = $mysql->query("SELECT * FROM (SELECT * FROM `jobs` WHERE $trigger2 LIKE '%$data2%') AS job WHERE $trigger1 LIKE '%$data1%'");
		$row = $result->num_rows;
        $lastPage = ceil($row/$countView);
		return $lastPage;
	}
	\endcode
	*/
?>