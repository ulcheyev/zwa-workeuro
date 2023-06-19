<?php 
    if(isset($_GET['filterSub'])){
        // Definice promennych
        $vacancy = htmlspecialchars(filter_var(trim($_GET['vacancy']), FILTER_SANITIZE_STRING)); 
        $company = htmlspecialchars(filter_var(trim($_GET['company']), FILTER_SANITIZE_STRING));   
        // Chyby 
        $errorCompany = $errorVacancy = '';

        // Kontola nastaveni filtru.
        // Pokud filtr je nastaven 1 inputem, vola se funkce pro zisk data s 1 parametrem.
        // Pokud filtr je nastaven 2 inputy, vola se funkce pri zisk data s 2 parametry.
        
        if($company != "" && $vacancy != ""){
            $newsData = getData2($mysql,'vacancy','company',$vacancy,$company);
            $lastPage = numOfRowsGetData2($mysql,'vacancy','company',$vacancy,$company);
        }
        elseif($vacancy != ""){
            $newsData = getData($mysql,'vacancy', $vacancy); 
            // Promenna lastPage je potreba pro vypocet celkoveho poctu polozek.
            // Ziskava se pomoci  (celkovy pocet polozek, ktere jsou vhodne podle filtru) rozdelit (pozadovany pocet zobrazenych objektu)
            $result = $mysql->query("SELECT COUNT(*) FROM `jobs` WHERE `vacancy` LIKE '%$vacancy%'");// Zisk celkoveho poctu polozek
            $row = $result->fetch_row(); // Vytvoreni pole s ciselnymi indexy s ziskanymi daty z databaze
            $lastPage = ceil($row[0]/$countView);// Operace deleni
        }
        elseif($company != ""){
            $newsData = getData($mysql,'company', $company);
            // Promenna lastPage je potreba pro vypocet celkoveho poctu polozek.
            // Ziskava se pomoci  (celkovy pocet polozek, ktere jsou vhodne podle filtru) rozdelit (pozadovany pocet zobrazenych objektu)
            $result = $mysql->query("SELECT COUNT(*) FROM `jobs` WHERE `company` LIKE '%$company%'"); // Zisk celkoveho poctu polozek
            $row = $result->fetch_row(); //Vytvoreni pole s ciselnymi indexy s ziskanymi daty z databaze
            $lastPage = ceil($row[0]/$countView); // Operace deleni
        }

        // Validace policek. Nevhodna situce, kdyz 2 pole jsou prazdna.
        if(empty($vacancy) && empty($company)){
            $errorCompany = $errorVacancy = 'Error';
        }
           
       
    
    }else{   ///< Pokud neni nastaven zadny filtr, je potreba zobrazit celou tabuli pro praci.
     
        $newsData = getDataAll($mysql);
        // Promenna lastPage je potreba pro vypocet celkoveho poctu polozek.
        // Ziskava se pomoci  (celkovy pocet polozek, ktere jsou vhodne podle filtru) rozdelit (pozadovany pocet zobrazenych objektu)
        $sql2 = $mysql->query("SELECT count(*) FROM `jobs`"); ///< Zisk celkoveho poctu polozek z tabule pro prace.
        $row = $sql2->fetch_row(); ///<Vytvoreni pole s ciselnymi indexy s ziskanymi daty z databaze
        $lastPage = ceil($row[0]/$countView); ///< Promenna lastPage je nutna pro vypocet celkoveho poctu polozek v stankovani. Ziskava se pomoci  (celkovy pocet polozek, ktere jsou vhodne podle filtru) rozdelit (pozadovany pocet zobrazenych objektu)
    }
    /*! \file
    Tento kod zkontroluje policky v formulari pro filtr a vyvola urcite funkce.
        1.  Pokud uzivatel stiskl tlacitko Search, vsechna odeslana data se zapisou do promennych.
        \code
        if(isset($_GET['filterSub'])){
        // Definice promennych
        $vacancy = htmlspecialchars(filter_var(trim($_GET['vacancy']), FILTER_SANITIZE_STRING));
        $company = htmlspecialchars(filter_var(trim($_GET['company']), FILTER_SANITIZE_STRING));
        \endcode

        2. Chyby pro zobrazeni
        \code
        $errorCompany = $errorVacancy = '';
        \endcode

        3. Kontola nastaveni filtru.
            a. Pokud filtr je nastaven 2 inputy, vola se funkce pri zisk data s 2 parametry.
            \code
            if($company != "" && $vacancy != ""){
            $newsData = getData2($mysql,'vacancy','company',$vacancy,$company);
            $lastPage = numOfRowsGetData2($mysql,'vacancy','company',$vacancy,$company);
            }
            \endcode
            b. Pokud filtr je nastaven 1 inputem, vola se funkce pro zisk data s 1 parametrem.
            
            Je nastavene pole vacancy
            \code
            elseif($vacancy != ""){
            // Zisk data odpovidajich inputu
            $newsData = getData($mysql,'vacancy', $vacancy); 
            // Zisk celkoveho poctu polozek odopovidajicich inputu
            $result = $mysql->query("SELECT COUNT(*) FROM `jobs` WHERE `vacancy` LIKE '%$vacancy%'");
            // Vytvoreni pole s ciselnymi indexy s ziskanymi daty z databaze
            $row = $result->fetch_row();
            //Promenna lastPage je potreba pro vypocet celkoveho poctu polozek v stankovani.
            // Ziskava se pomoci  (celkovy pocet polozek, ktere jsou vhodne podle filtru) rozdelit (pozadovany pocet zobrazenych objektu)
            $lastPage = ceil($row[0]/$countView);
            }
            \endcode
            Je nastavene pole company
            \code
            elseif($company != ""){
            // Zisk data odpovidajich inputu
            $newsData = getData($mysql,'company', $company);
            // Zisk celkoveho poctu polozek odopovidajicich inputu
            $result = $mysql->query("SELECT COUNT(*) FROM `jobs` WHERE `company` LIKE '%$company%'"); 
            //Vytvoreni pole s ciselnymi indexy s ziskanymi daty z databaze
            $row = $result->fetch_row();
            // Promenna lastPage je potreba pro vypocet celkoveho poctu polozek v stankovani.
            // Ziskava se pomoci  (celkovy pocet polozek, ktere jsou vhodne podle filtru) rozdelit (pozadovany pocet zobrazenych objektu)
            $lastPage = ceil($row[0]/$countView);
            }
            \endcode

        4. Validace policek. Nevhodna situce, kdyz 2 pole jsou prazdna.
            \code
            if(empty($vacancy) && empty($company)){
            $errorCompany = $errorVacancy = 'Error';
            }
            \endcode
        5. Pokud neni nastaven zadny filtr, je potreba zobrazit celou tabuli pro praci.
            \code
            else{
            $newsData = getDataAll($mysql);
            // Zisk celkoveho poctu polozek
            $sql2 = $mysql->query("SELECT count(*) FROM `jobs`");
            //Vytvoreni pole s ciselnymi indexy s ziskanymi daty z databaze
            $row = $sql2->fetch_row(); 
            // Promenna lastPage je potreba pro vypocet celkoveho poctu polozek.
            // Ziskava se pomoci  (celkovy pocet polozek, ktere jsou vhodne podle filtru) rozdelit (pozadovany pocet zobrazenych objektu)
            $lastPage = ceil($row[0]/$countView) 
        }
            \endcode
    */      
?>