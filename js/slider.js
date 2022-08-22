//METODO PARA MOVER LOS SLIDERS DEL FRONTEND
(function(){
    
    const sliders = [...document.querySelectorAll('.testimony__body')];
    const buttonNext = document.querySelector('#next');
    const buttonBefore = document.querySelector('#before');
    let value;
    //BOTTON CAMBIAR IMAGEN
    buttonNext.addEventListener('click', ()=>{
        changePosition(1);
    });
    //BOTTON RETROCERDER IMAGEN
    buttonBefore.addEventListener('click', ()=>{
        changePosition(-1);
    });

    const changePosition = (add)=>{
       const currentTestimony = document.querySelector('.testimony__body--show').dataset.id;
       value = Number(currentTestimony);
       value+= add;

       sliders[Number(currentTestimony)-1].classList.remove('testimony__body--show');
       if(value === sliders.length+1 || value === 0){
            value = value === 0 ? sliders.length : 1;
    }
    sliders[value-1].classList.add('testimony__body--show');
}

/////////////////////////////////////////////////////////////////////////////////////////////////////////////


//SCRIPT PARA LAS PREGUNTAS FRECUENTES

const tittleQuestions = [...document.querySelectorAll('.questions__tittle')];

    tittleQuestions.forEach(question =>{
        question.addEventListener('click', ()=>{
          let height = 0;
          let answer = question.nextElementSibling;
          let addPadding = question.parentElement.parentElement;

            addPadding.classList.toggle('questions__padding--add');
            question.children[0].classList.toggle('questions__arrow--rotate');
            if(answer.clientHeight === 0 ){
                height = answer.scrollHeight;
               
            }
            answer.style.height =  `${height}px`;

        });
    });

//MENU RESPONSIVE   
const openButton = document.querySelector('.nav__menu');
const menu = document.querySelector('.nav__link');
const closeMenu = document.querySelector('.nav__close');


openButton.addEventListener('click', ()=>{
   menu.classList.add('nav__link--show');   
});

closeMenu.addEventListener('click', ()=>{
   menu.classList.remove('nav__link--show'); 
});

   



})();

