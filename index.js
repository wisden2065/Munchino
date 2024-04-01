
// JAVASCRIPT FOR INDEX

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

// Search cancel functionality 
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


// add to cart functionality
const productContainerInIndex = document.querySelector(".box-container");   //get a ref to the htmlELement with the Id dishes-container which will be populated to display products with a function [displayFoodData()]
console.log(productContainerInIndex); 

productContainerInIndex.addEventListener("click", (g)=>{
    //the event parameter (g), is an object that tells us about the event 
    let clickedItem = g.target;     //using the target property to return the object where the same event occurred
    
    if(clickedItem.classList.contains("btn")){        //if object where the clicked event occurred contains the class .btn anywhere in its parent or sibling element
        let clickedParent = clickedItem.closest(".btn")  // 
        let productId = clickedParent.id;
        console.log("I have clicked on a button and the id is:", productId);
       addProductToCart(productId)
    }
})


 // adding functionality to search icon
 let form = document.querySelector("#search-form");
 let searchIcon = document.querySelector("#icon-searchProduct"); //gets a ref to the font awesome search icon

 let searchInput = form["input"];
 console.log(searchInput);
 console.log(searchIcon);


// logs value of input to console onKeyup
searchInput.addEventListener("keyup", ()=>{
   // console.log(searchInput.value);
})  

//  logs value of input onclick to the searchIcon
 searchIcon.addEventListener("click", ()=>{
   // console.log(searchInput.value);
   let filteredList =  productList.filter((newList)=>{
       return searchInput.value.includes(newList.name)
  
       displayProductList(filteredList)
   })
   // console.log(filteredList)
   console.log(filteredList);
   displayProductList(filteredList)
 })