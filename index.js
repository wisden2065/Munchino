

//navbar toggle to activeBtn-- onCLick
let allBtn = document.querySelectorAll(".navbar a")

allBtn.forEach((activeBtn) => { 
  activeBtn.addEventListener("click", ()=>{
    allBtn.forEach((e)=> e.classList.remove("active"));
    activeBtn.classList.add("active")
  })
});

// functionality for menu-list
let menu = document.querySelector("#menu-list-icon");
let navbar = document.querySelector(".navbar");

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

console.log('started all synchronous operations');
console.log('still in the index.js thread');
console.log('still in the index.js thread');
console.log('still in the index.js thread');
console.log('still in the index.js thread');

// Search cancel functionality 
let searchCancel = document.querySelector("#close");
console.log(searchCancel);
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

// swiper JS ends

const dishesList_container = document.querySelector(".box-container");   
console.log(dishesList_container); 


let productList = [];    //empty list that will be populated with data from JSON.

let cartList = [];  //empty list to store individual cartItems. The CartItem  would be added to the list after a click event is triggered on the btn 


//Asynchronous operation 1:  - populates the empty ProductList
const populateProductList =()=>{
    fetch("dishes.json")  //fetch food data from products.json file 
    .then(promiseObj => promiseObj.json())   // the fetch() returns an object which is a promise Object and that Object is converted to JSON with the .then()
    .then((data) => {productList = data;     //JSON assigned to the array productList
        console.log('completed fetching data');
        console.log('Resolved data: ',data);
        console.log(productList == data);
        pushProductListToUI();   //calling the fn to add list to UI
    }); 
}

populateProductList();

// Synchronous operations continues, till all synchronous tasks are completed before weaving into fetch() executes

// Asynchronous operation 2 :Displays the Product List to the UI
function pushProductListToUI(){   
    
console.log(productList.length);  // logs 12
let element = '';
    if(productList.length > 0){
        productList.forEach(product=>{
                                element += `<div class="box" id="${product.id}">
                                                <img src="${product.image}" alt="">
                                                <div class="content">
                                                    <h3>${product.foodName}</h3>
                                                    <div class="stars">
                                                        <i class="fas fa-star"></i>
                                                        <i class="fas fa-star"></i>
                                                        <i class="fas fa-star"></i>
                                                        <i class="fas fa-star"></i>
                                                        <i class="fas fa-star-half-alt"></i>
                                                    </div>
                                                    <div>
                                                        <span><i class="fas fa-naira-sign">${product.amount}</i></span> 
                                                        <a href="#" class="btn" id="${product.id}">Add to cart</a>
                                                    </div>
                                                </div>
                                            </div>`
                                    console.log('about to push productContainer to the UI in Idex page');

                                // productContainerInIndex.innerHTML = newArray;                      
                            })
        
        let newArray = [];
        newArray.push(element)
        dishesList_container.innerHTML = newArray;
    }
    else{
        console.log('No Item in productList');
    }
    console.log('last message in the function pushProductToUI() after the if() block');
}

   
console.log('Will i also print before the populateProductList()');



// Asynchronous operation 3: Thread of execution is weaved into this function after a click event is performed on the btn
// adding click event listener to dishesList container
dishesList_container.addEventListener("click", clickHandler )

// click event handler
function clickHandler(g){
    //the event parameter (g), is an object that tells us about the event 
    let clickedItem = g.target;     //using the target property to return the object where the same event occurred
    
    if(clickedItem.classList.contains("btn")){        //if object where the clicked event occurred contains the class .btn anywhere in its parent or sibling element
        let clickedParent = clickedItem.closest(".btn")  //
        let productId = clickedParent.id;
        console.log("I have clicked on a button in the ProductContainer and the id is:", productId);
       addProductToCart(productId)
    }
    else{
        console.log("You have clicked on an element that doesn't contain the class btn");
    }

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
  
       displayProductList(filteredList);
   })
   // console.log(filteredList)
   console.log(filteredList);
   displayProductList(filteredList)
 })

 console.log('Still in the thread of synchronous operation');



function addProductToCart(productId){
    console.log(cartList);
    console.log(cartList.length);   //previous length of classList array

    let indexofClickedItemInCartList = cartList.findIndex((value)=> value.productId == productId);    //finds the index of the object (element) whose index == the parameter passed to the function addProductToCart()
    console.log(indexofClickedItemInCartList);
    //check if cartList is empty. if true, we give a default value to the product_Id and quantity to 1
                if(cartList.length == 0){

                    console.log(cartList);
                    console.log(cartList.length);

                    cartList = [{
                        productId : productId,
                        quantity : 1
                    }]
                    console.log(cartList);
                }
                // if cartList is not empty, i.e an item (the product clicked) we may want to increment is quantity is already in the cart or not
                else if(indexofClickedItemInCartList < 0){    //the index of the item < 0, tells us that the item is not in the cart
                    cartList.push({                // so we push it into the cart
                        productId : productId,
                        quantity : 1
                    }) 
                    // console.log("this is the first item of this object");
                }
                else{   //else it is int the cart. So we increment its quantity if clicked again
                    // console.log("The item is already in cart"); 
                    cartList[indexofClickedItemInCartList].quantity = cartList[indexofClickedItemInCartList].quantity +  1;
                }
    console.log(cartList.length);  //present length of cartList array
    displayCartListToHTML()
}

let cartListUIcontainer = document.getElementById("cartBox")
console.log(cartListUIcontainer); 

function displayCartListToHTML(){

        let newLiInCartList = document.createElement("li");
        console.log(newLiInCartList);

        productList.forEach((product)=>{
                                            newLiInCartList += `<div class="cart-container" id="${product.id}">
                                                                    <div class="product-div"><img src="" alt=""></div>
                                                                            <div class="product-desc">
                                                                                <div class="product-wrapper">
                                                                                    <h3>${product.foodName}</h3>
                                                                                    <p>Just food</p>
                                                                                </div>
                                                                            </div>
                                                                            <div class="price-per-qty">
                                                                                <div class="price-wrapper">
                                                                                <p>Individually</p>
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
                                                                            <span class="add">
                                                                                <svg class="w-6 h-6 text-gray-800 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                                                                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 12h14"/>
                                                                                </svg>
                                                                            </span>
                                                                            <span id="amount">2</span>
                                                                            <span class="minus">
                                                                                <svg class="w-6 h-6 text-gray-800 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
                                                                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 12h14m-7 7V5"/>
                                                                                </svg>
                                                                            </span>
                                                                        </div>
                                                                    </div>
                                                                    <div class="sum">
                                                                        <div class="sum-wrapper">
                                                                            <span><i class="fas fa-naira-sign">${cartList.amount}</span>
                                                                        </div>
                                                                    </div>
                                                                </div>`

                                            
                                        })
        cartListUIcontainer.innerHTML = newLiInCartList;
}




// menu.json

let cartList2 = [];
// function to populate cartList2 with data from menu.json
function fetchMenuFoods(){
    const menuFoodItems = fetch('menu.json');
    menuFoodItems.then((promise)=>{
        promise.json()
        .then(data=>{
            cartList2 =data
            console.log(cartList2);
            populateMenu()
        })
    })
}
fetchMenuFoods();


let menuList_container = document.getElementById('box-container');
console.log(menuList_container);

// function to populate box_container with data from menu.json
console.log(cartList2);
function populateMenu(){














    
    console.log('In populateMenu()');
    let html = '';
    if(cartList2.length > 0){
        cartList2.forEach((e)=>{
            html +=`<div class="box" id="${e.id}">
                        <div class="image">
                            <img src="${e.image}" alt="">
                        </div>
                        <div class="content">
                            <h3>${e.foodName}</h3>
                            <div><i class="fas fa-naira-sign">${e.amount}</i></div>
                            <a href="#" class="btn food">add to cart</a>
                        </div>
                    </div>`
        })
        menuList_container.innerHTML = html;
    } 
    else{
        console.log('no item in cartList2 yet');
    }
}

// adding click event listener to products in menuList
menuList_container.addEventListener("click", clickHandler)



