// Autoresize textarea.
var textarea = document.querySelector('textarea');

textarea.addEventListener('keydown', autosize);
             
function autosize(){
  var el = this;
  setTimeout(function(){
    el.style.cssText = 'height:auto; padding:0';
    el.style.cssText = 'height:' + el.scrollHeight + 'px';
  },0);
}

// Count charachters.
const formjobs = document.querySelector(".formjobs");
const count = formjobs.querySelector("#num");
function countLetters() {
    const text = textarea.value;
    const textlength = textarea.value.length;  
    num.innerText = `${textlength}`;
}  
textarea.addEventListener('keypress', countLetters)
textarea.addEventListener('keydown', countLetters)
textarea.addEventListener('keyup', countLetters)
textarea.addEventListener('change', countLetters)

// Validace 
const vacancy = document.querySelector("#vacancy")
const company = document.querySelector("#company")
const location1 = document.querySelector("#location")
const involvement = document.querySelector("#involvement")
const vcdes = document.querySelector("#vcdes")

// Nastaveni udalosti
vacancy.addEventListener('blur', () => elemValidate(vacancy))
company.addEventListener('blur', () => elemValidate(company))
location1.addEventListener('blur', () => elemValidate(location1))
involvement.addEventListener('blur', () => elemValidate(involvement))
vcdes.addEventListener('blur', () => vcdesValidate(vcdes))
formjobs.addEventListener("submit", submitJ)

// Validace pro policka involvement, location, company, vacancy
function elemValidate(elem){
  if(elem.value.trim() != ""){
    if((elem.value.trim()).length < 35){
      elem.classList = "success"
      elem.nextElementSibling.classList = "invisJobs"
      elem.nextElementSibling.textContent = "0"
    }else{
      elem.classList = "fail"
      elem.nextElementSibling.classList = "chybaJobs"
      elem.nextElementSibling.textContent = "The length of " + elem.name + " can have MAX 35 charachters" 
    }
  }if(elem.value.trim() == ""){
    elem.classList = "box"
    elem.nextElementSibling.classList = "invisJobs"
    elem.nextElementSibling.textContent = "0"
  }
}

// Validace pro vacancy description
function vcdesValidate(elem){
  if(elem.value.trim() != ""){
    if((elem.value.trim()).length < 4000){
      elem.classList = "successText"
      elem.nextElementSibling.classList = "invisJobs"
      elem.nextElementSibling.textContent = "0"
    }else{
      elem.classList = "failText"
      elem.nextElementSibling.classList = "chybaJobs"
      elem.nextElementSibling.textContent = "The length of " + elem.name + " can have MAX 4000 charachters" 
    }
  }if(elem.value.trim() == ""){
    elem.classList = "boxText"
    elem.nextElementSibling.classList = "invisJobs"
    elem.nextElementSibling.textContent = "0"
  }
}
// Tato cast kodu je urcena pro kontrolu prazdnych policek po kliknuti tlacitka.
function submitJ(event){
    if(vacancy.value.trim() == ""){
      setError(event, vacancy)
      vacancy.nextElementSibling.textContent = "Vacancy field is required"
      isValidate = false
  }if(vacancy.classList == 'fail'){
      event.preventDefault()
  }if(company.value.trim() == ""){
      setError(event, company)
      company.nextElementSibling.textContent = "Company field is required"
      isValidate = false
  }if(company.classList == 'fail'){
      event.preventDefault()
  }if(location1.value.trim() == ""){
      setError(event, location1)
      location1.nextElementSibling.textContent = "Location field is required"
      isValidate = false
  }if(location.classList == 'fail'){
      event.preventDefault()
  }if(involvement.value.trim() == ""){
      setError(event, involvement)
      involvement.nextElementSibling.textContent = "Involvement field is required"
      isValidate = false
  }if(involvement.classList == 'fail'){
      event.preventDefault()
  }if(vcdes.value.trim() == ""){
    event.preventDefault()
    vcdes.classList = 'failText'
    vcdes.nextElementSibling.classList = 'failMsg'
    vcdes.nextElementSibling.textContent = "Vacancy Description field is required"
  }if(vcdes.classList == 'failText'){
      event.preventDefault()
  }
}

// Funkce slouzi k nastaveni chyby pro inputy, kdyz uzivatel tiskne tlacitko Post a job
function setError(event, elem){
  event.preventDefault()
  elem.classList = 'fail'
  elem.nextElementSibling.classList = 'failMsg'
}


