// Autoresize textarea.
var textarea = document.querySelector('textarea');
textarea.addEventListener('keydown', autosize);

// Funkce meni rozmer pole textarea.   
function autosize(){
  var el = this;
  setTimeout(function(){
    el.style.cssText = 'height:auto; padding:0';
    el.style.cssText = 'height:' + el.scrollHeight + 'px';
  },0);
}

// Count charachters.
const formnews = document.querySelector(".formnews");
const count = formnews.querySelector("#num");

// Funkce meni obsah html tagu s id num na vypoctenou hodnotu. Ta je poctem symnolu textarea
function countLetters() {
    const text = textarea.value;
    const textlength = textarea.value.length;  
    num.innerText = `${textlength}`;
}  
textarea.addEventListener('keypress', countLetters)
textarea.addEventListener('keydown', countLetters)
textarea.addEventListener('keyup', countLetters)
textarea.addEventListener('change', countLetters)

// Vyber nutnych elementu
const formpublish = document.querySelector('.formnews')
const title =  document.querySelector("#title");
const text = document.querySelector("#newstext");
const image = document.querySelector("#image");

// Nastaveni udalosti
title.addEventListener('blur', () => elemValidate(title))
text.addEventListener('blur', () => elemValidate(text))
formpublish.addEventListener('submit', submitY)
image.addEventListener('blur', () => elemValidate(image))


//Validace policek text, title a image
function elemValidate(elem){
  if(elem == title){
    if((elem.value.trim()).length < 125){
      elem.classList = "success"
      elem.nextElementSibling.classList = "invisJobs"
      elem.nextElementSibling.textContent = ""
    }else{
      elem.classList = "fail"
      elem.nextElementSibling.classList = "chybaJobs"
      elem.nextElementSibling.textContent = "The length of " + elem.name + " can have MAX 125 charachters" 
    }
    }if(elem.value.trim() == ""){
    elem.classList = "box"
    elem.nextElementSibling.classList = "invisJobs"
    elem.nextElementSibling.textContent = ""
  }
  if(elem == text){
    if(elem.value != ""){
      if((elem.value.trim()).length < 4000){
        elem.classList = "successText"
        elem.nextElementSibling.classList = "invisJobs"
        elem.nextElementSibling.textContent = ""
      }else{
        elem.classList = "failText"
        elem.nextElementSibling.classList = "chybaJobs"
        elem.nextElementSibling.textContent = "The length of " + elem.name + " can have MAX 4000 charachters" 
      }
    }if(elem.value.trim() == ""){
      elem.classList = "boxText"
      elem.nextElementSibling.classList = "invisJobs"
      elem.nextElementSibling.textContent = ""
    }
  }
  if(elem == image){
    if(image.value){
      image.nextElementSibling.classList = "invisJobs"
      image.nextElementSibling.textContent = ""
    }
  }
}

// Tato cast kodu je urcena pro kontrolu prazdnych policek po kliknuti tlacitka.
function submitY(event){
  if(title.value.trim() == ""){
      event.preventDefault()
      title.classList = 'fail'
      title.nextElementSibling.classList = 'failMsg'
      title.nextElementSibling.textContent = "Title is required"
  }if(title.classList == 'fail'){
      event.preventDefault()
  }if(!image.value){
      event.preventDefault()
      image.nextElementSibling.classList = "chybaJobs"
      image.nextElementSibling.textContent = "Image is required"
  }if(image.nextElementSibling.classList == 'chybaJobs'){
      event.preventDefault()
  }if(text.value.trim() == ""){
      event.preventDefault()
      text.classList = "failText"
      text.nextElementSibling.classList = "chybaJobs"
      text.nextElementSibling.textContent = "News text is required"
  }if(text.classList == 'failText'){
      event.preventDefault()
  }
}
