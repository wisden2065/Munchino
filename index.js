
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



// JAVASCRIPT FOR cart file
// functionality to maintain icon color onclick
let iconToBeClick = document.querySelector(".icons");
// console.log(iconToBeClick.children);
iconToBeClick.children.addEventListener("click", ()=>{
  iconToBeClick.children.classList.toggle("color_click")
})
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






// // Dish Section========


// //function to display food data

// function displayFood(foodObjects){

//     const boxContainer = document.getElementById("dishes-container");
//     let html = "";
//     foodObjects.forEach((foodObject) => {  //why is id property unimportant
//         html  += `<div class="box" id="${foodObject.id}" >                 
//         <img src="${foodObject.image}" alt="">
//         <div class="content">
//             <h3>${foodObject.foodName}</h3>
//             <div class="stars">
//                 <i class="fas fa-star"></i>
//                 <i class="fas fa-star"></i>
//                 <i class="fas fa-star"></i>
//                 <i class="fas fa-star"></i>
//                 <i class="fas fa-star-half-alt"></i>
//                 <span>N${foodObject.amount}</span> 
//                 <a href="#" class="btn" id="${foodObject.id}">Add to cart</a>
//             </div>
//         </div>
//     </div>`
//     });

//     boxContainer.innerHTML = html;
// }

// displayFood(allFoodData);




let cartContainer = document.querySelector("#cart_ul");
let cartBox = document.querySelector(".cart-box");           //get a ref to the htmlElement with the id cart_ul, which will be populated with the function [addToCart()]
let spanCounter = document.getElementById("cartTotal");                //get a ref to the span for number of items

console.log(cartContainer);  //nul
console.log(cartBox);       //null
console.log(spanCounter);


const productContainer = document.querySelector(".box-container");   //get a ref to the htmlELement with the Id dishes-container which will be populated to display products with a function [displayFoodData()]
console.log(productContainer); 

let productList = [];    //declares an empty array that will be populated with data from JSON. This List would contain all the available products that would later be displayed to the UI

let cartList = [];  //declares an empty array to store individual cartItems. The CartItem  would be added to the list after a click event is triggered on the btn 


//populates the empty Product List
const populateProductList =()=>{

    fetch("products.json")  //fetch food data from products.json file 
    .then(promiseObj => promiseObj.json())   // the fetch() returns an object which is a promise Object and that Object is converted to JSON with the .then()
    .then((data) => {productList = data;     //JSON assigned to the array productList
        console.log(data);
        displayProductList();   //calling the fn to add list to UI
    });
}

populateProductList(); 


// Displays the Product List to the UI
function displayProductList(){   
    // productContainer.innerHTML = "";
    let html = "";   //creates a variable html that would be the inner value of the objects of the array and overwrites the previous content
    console.log(productList.length);
    
    if(productList.length >= 0){
        productList.forEach(product=>{   //the forEach loop iterates through the arrayList(productList), and generates a html content for each object in the array
            // let newProduct = document.createElement("div");
            // newProduct.classList.add("box")
            // newProduct.dataset.id = product.id
            // a string variable html is created to store the HTML markup as a string and is assigned to each element (product) in the array
        //    the += appends/concatenates the HTML for each iteration to the existing HTML content in html
          html += `<div class="box" id="${product.id}">    
                                        <img src="${product.image}" alt="">
                                        <div class="content">
                                            <h3>${product.foodName}</h3>
                                            <div class="stars">
                                                <i class="fas fa-star"></i>
                                                <i class="fas fa-star"></i>
                                                <i class="fas fa-star"></i>
                                                <i class="fas fa-star"></i>
                                                <i class="fas fa-star-half-alt"></i>
                                                <span>N${product.amount}</span> 
                                                <a href="#" class="btn" id="${product.id}">Add to cart</a>
                                            </div>
                                        </div>
                                        </div>`
                                        productContainer.innerHTML = html;  //sets the generated HTML to the div(productContainer)
       
                                        // productContainer.appendChild(newProduct); //code resulted into a bug when this line was placed after the forEach loop

                                        // console.log("In the loop");
        })
        
    }
  
    }


//adding a general eventListener on the productContainer that houses individual food Object
productContainer.addEventListener("click", (g)=>{
    //the event parameter (g), is an object that tells us about the event 
    let clickedItem = g.target;     //using the target property to return the object where the same event occurred
    
    if(clickedItem.classList.contains("btn")){        //if object where the clicked event occurred contains the class .btn anywhere in its parent or sibling element
        let clickedParent = clickedItem.closest(".btn")  // 
        let productId = clickedParent.id;
        console.log("I have clicked on a button and the id is:", productId);
       addProductToCart(productId)
    }
})



function addProductToCart(productId){
    
    let indexofItemInCart = cartList.findIndex((value)=> value.productId == productId);    //finds the index of the object (element) whose index == the parameter passed to the function addProductToCart()

    //check if cartList is empty. if true, we give a default value to the product_Id and quantity to 1
    if(cartList.length < 0){
        cartList = [{
            productId : productId,
            amount : 2
        }]
    }
    // if cartList is not empty, i.e an item (the product clicked) we may want to increment is quantity is already in the cart or not
    else if(indexofItemInCart < 0){    //the index of the item < 0, tells us that the item is not in the cart
        cartList.push({                // so we push it into the cart
            productId : productId,
            quantity : 1
        }) 
        // console.log("this is the first item of this object");
    }
    else{   //else it is int the cart. So we increment its quantity if clicked again
        // console.log("The item is already in cart"); 
        cartList[indexofItemInCart].quantity = cartList[indexofItemInCart].quantity +  1;
    }
    console.log(cartList);
    displayCartListToHTML()
}



function displayCartListToHTML(){

        let cartListWrapper = document.querySelector("#cart_ul");
    
        let newLiInCartList = document.createElement("li");

        productList.forEach((product)=>{
            newLiInCartList += `
            <div class="cart-container" id="">
            <div class="product-div"><img src="" alt=""></div>
            <div class="product-desc">
           <div class="product-wrapper">
                <h3>${product.foodName}</h3>
                <p>Just food</p>
            </div>
            </div>
            <div class="price-per-qty">
            <div class="price-wrapper">
                <p>Individualy</p>
                <span>Now $${cartList.amount}</span>
            </div>
            </div>
            <div class="remove-item">
            <div class="del-wrapper">
                <svg class="w-6 h-6 text-gray-800 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.2" d="M5 7h14m-9 3v8m4-8v8M10 3h4a1 1 0 0 1 1 1v3H9V4a1 1 0 0 1 1-1ZM6 7h12v13a1 1 0 0 1-1 1H7a1 1 0 0 1-1-1V7Z"/>
                </svg>
            </div>
            </div>
            <div class="shop-cart">
            <div class="cart-wrapper">
                <span class="add" ><svg class="w-6 h-6 text-gray-800 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 12h14"/>
                </svg></span>
                <span id="amount">2</span>
                <span class="minus"><svg class="w-6 h-6 text-gray-800 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 12h14m-7 7V5"/>
                </svg></span>
            </div>
            </div>
            <div class="sum">
            <div class="sum-wrapper">
                <span>$${cartList.amount}</span>
            </div>
            </div>
        </div>`;
        cartListWrapper.innerHTML = newLiInCartList;

        })
}


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

        
    



    




 