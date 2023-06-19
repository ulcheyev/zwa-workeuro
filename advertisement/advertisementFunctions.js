// Validace
const formapply = document.querySelector('.applynow1')
const firstname = document.querySelector("#firstname")
const lastname = document.querySelector("#lastname")
const number = document.querySelector("#number")
//RegEx
const regExPhone = /^[+]\(?([0-9]{3})\)?[-. ]?([0-9]{3})[-. ]?([0-9]{3})[-. ]?([0-9]{3})$/
const regExName = /^[a-zA-Z ]+$/

//Nastaveni udalosti
lastname.addEventListener('blur', () => elemValidate(lastname))
firstname.addEventListener('blur', () => elemValidate(firstname))
formapply.addEventListener('submit', submitP)
number.addEventListener('blur', () => numberValidate(number))

//Validace policek lastname, firstname 
function elemValidate(elem){
      if(!regExName.test(elem.value) && elem.value != ""){
        elem.classList = "failAd"
        elem.nextElementSibling.classList = "adError"
        elem.nextElementSibling.textContent = "Incorrect input"
      }else{
        elem.classList = "successAd"
        elem.nextElementSibling.classList = "ad"
        elem.nextElementSibling.textContent = ""
      }
      if(elem.value == ""){
        elem.classList = "inputy"
        elem.nextElementSibling.classList = "ad"
        elem.nextElementSibling.textContent = ""
      }

}
//Validace telefonniho cisla 
function numberValidate(number){
    if (!regExPhone.test(number.value) && number.value !=""){
        number.classList = "failAd"
        number.nextElementSibling.classList = "adError"
        number.nextElementSibling.textContent = "Invalid phone number"
    } else{
        if(number.value==""){
            number.classList = "inputy"
            number.nextElementSibling.classList = "ad"
            number.nextElementSibling.textContent = ""
        }else{
            number.classList = "successAd"
            number.nextElementSibling.classList = "ad"
            number.nextElementSibling.textContent = ""
        }
    }
}


// Tato cast kodu je urcena pro kontrolu prazdnych policek po kliknuti tlacitka.
function submitP(event){
    let res = 0
    if(firstname.value == ""){
        event.preventDefault()
        firstname.classList = 'failAd'
        firstname.nextElementSibling.classList = 'adError'
        res ++
        firstname.nextElementSibling.textContent = "The field is required"
    }if(firstname.classList == 'failAd'){
        event.preventDefault()
        res ++
    }if(lastname.value == ""){
        event.preventDefault()
        lastname.classList = 'failAd'
        lastname.nextElementSibling.classList = "adError"
        lastname.nextElementSibling.textContent = "The field is required"
        res ++
    }if(lastname.classList == 'failAd'){
        event.preventDefault()
        res ++
    }if(number.value == ""){
        event.preventDefault()
        number.classList = "failAd"
        number.nextElementSibling.classList = "adError"
        number.nextElementSibling.textContent = "The field is required"
        res ++
    }if(number.classList == 'failAd'){
        event.preventDefault()
        res ++
    }if(res == 0){
        alert('You will be contacted')
    }
}







