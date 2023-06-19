// Definice 
const form = document.querySelector('.filterProJobs')
const vacancy = document.querySelector('#vacancy')
const company = document.querySelector('#company')
// Nasataveni udalosti
form.addEventListener('submit', validate)
vacancy.addEventListener('blur', () => validateIn(vacancy))
company.addEventListener('blur', () => validateIn(company))

//Validace pri blur.
function validateIn(elem){
    if(elem.value.classList = "failFilter"){
         if(elem.value != ""){
             elem.classList = "inputFilter"
         }
    }
}
// Validace inputu po kliknuti tlacitka.
function validate(event){
    if(vacancy.value == "" && company.value == "" ){
        event.preventDefault()
        vacancy.classList = 'failFilter'
        company.classList = 'failFilter'
    }
}
