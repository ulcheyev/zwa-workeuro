// Vyber nutnych elementu
const formlogin = document.querySelector('.loginForm');
const user = document.querySelector('#username');
const password = document.querySelector('#password');

// Nastaveni udalosti
user.addEventListener('blur', userValidate)
password.addEventListener('blur', passValidate)
formlogin.addEventListener('submit', submitF)

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

// Funkce validace

// Validace username
function userValidate(){
    if(user.value.trim() !== ''){
        ajaxGet("../functions/ajaxRequest.php?", "usernamelog="+user.value, user)
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
        })
    }if(user.value == ""){
        user.classList = "box"
        user.nextElementSibling.classList = "invis"
        user.nextElementSibling.textContent = ""  
    }

}

// Validace password
function passValidate(){
    if(password.value != ''){
        if(user.classList != "fail"){
            password.classList = "success"
            password.nextElementSibling.classList = "invis"
            password.nextElementSibling.textContent = ""
        }else{
            password.classList = "fail"
        }
    }else{
        password.classList = "fail"
        password.nextElementSibling.classList = "failMsg"
        password.nextElementSibling.textContent = "Password is required"
    }if(password.value == ""){
        password.classList = "box"
        password.nextElementSibling.classList = "invis"
        password.nextElementSibling.textContent = ""
    }

}
// Tato funkce je urcena pro kontrolu prazdnych policek po kliknuti tlacitka.
function submitF(event){
    if(user.value === "" && password.value === ""){
        event.preventDefault()
        user.classList = "fail"
        user.nextElementSibling.classList = "failMsg"
        user.nextElementSibling.textContent = "Username is required"
        password.classList = "fail"
        password.nextElementSibling.classList = "failMsg"
        password.nextElementSibling.textContent = "Password is required"
    }if(user.value === ""){
        event.preventDefault()
        user.classList = "fail"
        user.nextElementSibling.classList = "failMsg"
        user.nextElementSibling.textContent = "Username is required"
    }if(password.value === ""){
        event.preventDefault()
        password.classList = "fail"
        password.nextElementSibling.classList = "failMsg"
        password.nextElementSibling.textContent = "Password is required"
    }
 
}









