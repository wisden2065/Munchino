

//navbar toggle to activeBtn-- onCLick
let allBtn = document.querySelectorAll(".navbar a")
// console.log(allBtn);

allBtn.forEach((activeBtn) => { 
  // console.log(activeBtn.innerHTML)
  activeBtn.addEventListener("click", ()=>{
    allBtn.forEach((e)=> e.classList.remove("active"));

    activeBtn.classList.add("active")

  })
});

// functionality for menu-list
let menu = document.querySelector("#menu-list-icon");
let navbar = document.querySelector(".navbar");

// console.log(navbar);
// console.log(menu);
menu.onclick = ()=>{
  menu.classList.toggle("fa-xmark");
  navbar.classList.toggle("navList-activate")
}

//functionality for search-icon
let search = document.querySelector("#search-icon");
let searchToggle = document.querySelector("#search-form");

search.onclick =()=>{
    searchToggle.classList.toggle("activate-searchForm");
}

let searchCancel = document.querySelector("#close");

searchCancel.onclick =()=>{
    searchToggle.classList.remove("activate-searchForm");
}

//functionality for cart-icon
let cartIcon = document.querySelector("#cart-icon");
let cart = document.querySelector(".cart");
cartIcon.onclick=()=>{
  cart.classList.toggle("cart-containerAdd")
  cartIcon.classList.toggle("color")
}
//swiper js begins here
const swiper = new Swiper('.swiper', {
    // Optional parameters
    loop: true ,
    speed: 2000, 
    autoplay:{
      delay:3000,
      disableOnInteraction:false,
    },
  
    // If we need pagination
    pagination: {
      el: '.swiper-pagination',
    },
  
    // Navigation arrows
    navigation: {
      nextEl: '.swiper-button-next',
      prevEl: '.swiper-button-prev',
    },
  
  });



 