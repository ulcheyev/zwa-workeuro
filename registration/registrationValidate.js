

// RegExp
// Email cvut@cvut.cz
const regExpEmail = /[A-Z0-9._%+-]+@[A-Z0-9-]+.+.[A-Z]{2,4}$/i

// Uzivatelske jmeno muze mit jenom pismena a cisla.
const regExpName = /^([A-Za-z0-9_-]{3,15})$/ 

// Hesla museji obsahovat alespon 
// jedno velke pismeno, jedno cislo. Ostatni symboly jsou na vyber. 
// Dohromady musi byt 8 symbolu a vic.
const regExpPass = /^(?=.*\d)(?=.*[A-Z]).{8,}$/ 



// // Tento element slouzi pro oznameni, meni se na true, kdyz policko se stalo uspesnym.
let isValidate = false

// Vyber nutnych elementu
const regform = document.querySelector('.regForm')
const user = document.querySelector('#username')
const email = document.querySelector('#email')
const pass = document.querySelector('#password')
const passConf = document.querySelector('#cpassword')




// Nastaveni udalosti
user.addEventListener('blur', userValidate)
pass.addEventListener('blur', passValidate)
passConf.addEventListener('blur', passConfValidate)
email.addEventListener('blur', emailValidate)
regform.addEventListener('submit', submitT)


// Funkce sleep je urcena pro to, aby odpoved od serveru stihla prijit a 
// byla moznost zmenit border policka.
function sleep (time) {
     return new Promise((resolve) => setTimeout(resolve, time));
}

// AJAX KONTROLA EXISTENCE USENAME V DB. Prijima url - kam bude dotaz, params - parametry dotazu
// tag - html element, u ktereho se zobrazi chyba.
function ajaxGet(url, params, tag){


    var request = new XMLHttpRequest()
    // Pokud stav dotazu je hotovy
    request.onreadystatechange = function(){
        // Pokud odpoved serveru je uspesna a stav dotazu je hotovy
        if(request.readyState == 4 && request.status == 200){
            // Zobrazit odpoved serveru do html tagu pod inputem
            const responseTextServer = tag.nextElementSibling
            responseTextServer.innerHTML = request.responseText
        }
    }

    // Inicializace dotazu
    request.open('GET', encodeURI(url+params))
    
    // Samotny dotaz
    request.send()
}


// Validace username
function userValidate(){
    if (!regExpName.test(user.value.trim()) && user.value.trim() !=""){
        if((user.value.trim()).length < 3 || (user.value.trim()).length > 15){
            user.classList = "fail"
            user.nextElementSibling.classList = "failMsg"
            user.nextElementSibling.textContent = "Username must contain MIN 3 MAX 15 charachters"
            isValidate = false
        }else{ 
            user.classList = "fail"
            user.nextElementSibling.classList = "failMsg"
            user.nextElementSibling.textContent = "Username must contain ONLY letters and numbers"
            isValidate = false  
        }          
    } else {
        if(user.value.trim() != ""){
            // Pouziti ajax.
            ajaxGet("../functions/ajaxRequest.php?", "username="+user.value, user)
            sleep(370).then(() => {
                // Po vykonani funkce sleep nasleduje kontrola, jesti prisla nejaka chyba.
                if(user.nextElementSibling.textContent != ""){
                    user.classList = "fail"
                    user.nextElementSibling.classList = "failMsg"
                    isValidate = false
                }else{
                    user.classList = "success"
                    user.nextElementSibling.classList = "invis"
                    user.nextElementSibling.textContent = ""
                    isValidate = true
    
                }
            });
        }else{
            user.classList = "box"
            user.nextElementSibling.classList = "invis"
            user.nextElementSibling.textContent = ""  
        }    
    }
}


// Validace email

function emailValidate (){
    if (!regExpEmail.test(email.value) && email.value !=""){
        email.classList = "fail"
        email.nextElementSibling.classList = "failMsg"
        email.nextElementSibling.textContent = "Email should be in the form zwa@cvut.cz" 
        isValidate = false
    } else {
        if(email.value != ""){
            ajaxGet("../functions/ajaxRequest.php?", "email="+email.value, email)
            sleep(250).then(() => {
                if(email.nextElementSibling.textContent != ""){
                    email.classList = "fail"
                    email.nextElementSibling.classList = "failMsg"
                    isValidate = false
                }else{
                    email.classList = "success"
                    email.nextElementSibling.classList = "invis"
                    email.nextElementSibling.textContent = ""
                    isValidate = true
                }
            });
        }else{
            email.classList = "box"
            email.nextElementSibling.classList = "invis"
            email.nextElementSibling.textContent = ""  
        
        }
    }
}

// Validace hesla 

function passValidate(){
    // Kontrola samotneho hesla.
    if (!regExpPass.test(pass.value) && pass.value !=""){
        if(pass.value.length < 8){
            pass.classList = "fail"
            pass.nextElementSibling.classList = "failMsg"
            pass.nextElementSibling.textContent = "Password must contain MIN 8 charachters"
            isValidate = false
        }else{
            pass.classList = "fail"
            pass.nextElementSibling.classList = "failMsg"
            pass.nextElementSibling.textContent = "Password must contain at least one capital letter and one number" 
            isValidate = false
        }
    }else {
        if(pass.value != ""){
            pass.classList = "success"
            pass.nextElementSibling.classList = "invis"
            pass.nextElementSibling.textContent = ""  
            isValidate = true
        }else{
            pass.classList = "box"
            pass.nextElementSibling.classList = "invis"
            pass.nextElementSibling.textContent = ""  
        }
    }
    // Kontrola totoznosti password a password confirm.
    if(pass.value != passConf.value && passConf.value != ""){
        pass.classList="fail"
        pass.nextElementSibling.classList = "failMsg"
        pass.nextElementSibling.textContent = "Passwords must mutch"
        passConf.classList = "fail"
        passConf.nextElementSibling.classList = "failMsg"
        passConf.nextElementSibling.textContent = "Passwords must mutch"
        isValidate = false
    }else{
        if(passConf.value != "" && pass.classList != "fail"){
            pass.classList="success"
            pass.nextElementSibling.classList = "invis"
            pass.nextElementSibling.textContent = ""
            passConf.classList = "success"
            passConf.nextElementSibling.classList = "invis"
            passConf.nextElementSibling.textContent = ""
            isValidate = true
        }
    }
}

// Validace Password Confirm
function passConfValidate(){
    // Kontrola confirm password na totoznost s password.
    if(pass.value != passConf.value && pass.value != ""){
        pass.classList="fail"
        pass.nextElementSibling.classList = "failMsg"
        pass.nextElementSibling.textContent = "Passwords must mutch"
        passConf.classList = "fail"
        passConf.nextElementSibling.classList = "failMsg"
        passConf.nextElementSibling.textContent = "Passwords must mutch"
        isValidate = false
    }else{
        if(passConf.value != "" && pass.classList != "fail"){
            if(pass.value != ""){
                pass.classList="success"
                pass.nextElementSibling.classList = "invis"
                pass.nextElementSibling.textContent = ""
                passConf.classList = "success"
                passConf.nextElementSibling.classList = "invis"
                passConf.nextElementSibling.textContent = ""
                isValidate = true
            }else{
                pass.classList="fail"
                pass.nextElementSibling.classList = "invis"
                pass.nextElementSibling.textContent = ""
                passConf.classList = "fail"
                passConf.nextElementSibling.classList = "invis"
                passConf.nextElementSibling.textContent = ""
                isValidate = false

            }
        }else{
            if(passConf.value==""){
                passConf.classList = "box"
                passConf.nextElementSibling.classList = "invis"
                passConf.nextElementSibling.textContent = ""

            }else{
            passConf.classList = "fail"
            passConf.nextElementSibling.classList = "invis"
            passConf.nextElementSibling.textContent = ""
            isValidate = false
            }
        }
    }
}


// Tato cast kodu je urcena pro kontrolu prazdnych policek po kliknuti tlacitka.
function submitT(event){
    if(user.value == ""){
        setError(event, user)
        user.nextElementSibling.textContent = "Username is required"
        isValidate = false
    }if(user.classList == 'fail'){
        event.preventDefault()
    }if(pass.value == ""){
        setError(event, pass)
        pass.nextElementSibling.textContent = "Password is required"
        isValidate = false
    }if(pass.classList == 'fail'){
        event.preventDefault()
    }if(email.value == ""){
        setError(event, email)
        email.nextElementSibling.textContent = "Email is required"
        isValidate = false
    }if(email.classList == 'fail'){
        event.preventDefault()
    }if(passConf.value == ""){
        setError(event, passConf)
        passConf.nextElementSibling.textContent = "Password confirm is required"
        isValidate = false
    }if(passConf.classList == 'fail'){
        event.preventDefault()
    }
}

// Funkce slouzi k nastaveni chyby pro inputy, kdyz uzivatel tiskne tlacitko Sign Up
function setError(event, elem){
    event.preventDefault()
    elem.classList = 'fail'
    elem.nextElementSibling.classList = 'failMsg'
}













