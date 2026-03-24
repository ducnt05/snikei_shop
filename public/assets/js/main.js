window.addEventListener("load", function () {
  setTimeout(function () {
    document.querySelector(".hero").classList.add("active");
  }, 300);
});
const slides = document.querySelector(".slides");
const slide = document.querySelectorAll(".slide");

let index = 0;

function autoSlide(){
    index++;

    if(index >= slide.length){
        index = 0;
    }

    slides.style.transform = `translateX(${-index * 1200}px)`;
}

setInterval(autoSlide,3000);
window.addEventListener("scroll", function(){

  const element = document.querySelector(".form-slide");

  const position = element.getBoundingClientRect().top;
  const screenHeight = window.innerHeight;

  if(position < screenHeight - 100){
      element.classList.add("active");
  }

});
window.addEventListener("scroll", function(){

  const element = document.querySelector(".features");

  const position = element.getBoundingClientRect().top;
  const screenHeight = window.innerHeight;

  if(position < screenHeight - 100){
      element.classList.add("active");
  }

});
window.addEventListener("scroll", function(){

  const element = document.querySelector(".category-banner1");

  const position = element.getBoundingClientRect().top;
  const screenHeight = window.innerHeight;

  if(position < screenHeight - 100){
      element.classList.add("active");
  }

});
window.addEventListener("scroll", function(){

  const element = document.querySelector(".category-banner2");

  const position = element.getBoundingClientRect().top;
  const screenHeight = window.innerHeight;

  if(position < screenHeight - 100){
      element.classList.add("active");
  }

});
window.addEventListener("scroll", function(){

  const element = document.querySelector(".form-contact .form-left");

  const position = element.getBoundingClientRect().top;
  const screenHeight = window.innerHeight;

  if(position < screenHeight - 100){
      element.classList.add("active");
  }

});
window.addEventListener("scroll", function(){

  const element = document.querySelector(".form-contact .form-right");

  const position = element.getBoundingClientRect().top;
  const screenHeight = window.innerHeight;

  if(position < screenHeight - 100){
      element.classList.add("active");
  }

});
if (document.querySelector(".btn-shop")) {
  const btnShop = document.querySelector(".btn-shop");
  btnShop.addEventListener("click", function () {
    window.location.href = "./shop";
  });
}
if (document.querySelector(".btn-categories")) {
  const btnCategories = document.querySelector(".btn-categories");
  btnCategories.addEventListener("click", function () {
    window.location.href = "./categories";
  });
}