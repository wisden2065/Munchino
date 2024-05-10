
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



let productList = [];    //To be populated with data from dishes.json by fetchDishesFood()

let cartList = [];  //empty list to store individual cartItems. The CartItem  would be added to the list after a click event is triggered on the btn 


//Asynchronous operation 1:  - populates the empty ProductList
const fetchDishesFood =()=>{
    fetch("dishes.json")  //fetch food data from products.json file 
    .then(promiseObj => promiseObj.json())   // the fetch() returns an object which is a promise Object and that Object is converted to JSON with the .then()
    .then((data) => {productList = data;     //JSON assigned to the array productList
        console.log('completed fetching data');
        console.log('Resolved data: ',data);
        console.log(productList == data);

        // pushProductListToUI();   //calling the fn to add list to UI
    }); 
}

fetchDishesFood();

let cartList2 = [];  //To be populated with menu.json by fetchMenuFoods()

// function to populate cartList2 with data from menu.json
function fetchMenuFoods(){
    const menuFoodItems = fetch('menu.json');
    menuFoodItems.then((promise)=>{
        promise.json()
        .then(data=>{
            cartList2 =data
            console.log(cartList2);
            pushMenuFoodListToUI()
        })
    })
}
fetchMenuFoods();

// Asynchronous operation 2 :Displays the Product List to the UI
const dishesList_container = document.querySelector(".box-container");   
console.log(dishesList_container); 

function pushProductListToUI(){    
    console.log(productList.length);  // logs 12
    let element = '';
    if(productList.length > 0){
        productList.forEach(product=>{
                                // element += `<div class="box" id="${product.id}">
                                //                 <img src="${product.image}" alt="">
                                //                 <div class="content">
                                //                     <h3>${product.foodName}</h3>
                                //                     <div class="stars">
                                //                         <i class="fas fa-star"></i>
                                //                         <i class="fas fa-star"></i>
                                //                         <i class="fas fa-star"></i>
                                //                         <i class="fas fa-star"></i>
                                //                         <i class="fas fa-star-half-alt"></i>
                                //                     </div>
                                //                     <div>
                                //                         <span><i class="fas fa-naira-sign">${product.amount}</i></span> 
                                //                         <a href="#" class="btn" id="${product.id}">Add to cart</a>
                                //                     </div>
                                //                 </div>
                                //             </div>`
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

 // function to populate box_container with data from menu.json
let menuList_container = document.getElementById('box-container');
console.log(menuList_container);

function pushMenuFoodListToUI(){    
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
                            <a href="#" class="btn food" id="${e.id}">add to cart</a>
                        </div>
                    </div>`
        })
        menuList_container.innerHTML = html;
    } 
    else{
        console.log('no item in cartList2 yet');
    }
}


// click event handler
function clickHandler(g){
    //the event parameter (g), is an object that tells us about the event 
    let clickedItem = g.target;     //using the target property to return the object where the same event occurred
    
    if(clickedItem.classList.contains("btn")){   
        let clickedParent = clickedItem.closest(".btn") 
        console.log(clickedParent);
        let productId = clickedParent.id;
        console.log("I have clicked on a button in the ProductContainer and the id is:", productId);
        console.log(typeof productId);
        productIdToInt = parseInt(productId)
        console.log(typeof productIdToInt);
        productId = productIdToInt;

        // passing the local storage value on click
        
       
    }
    else{
        console.log("You have clicked on an element that doesn't contain the class btn");
    }

}

function addProductToCart(productId){
    console.log(cartList);
    console.log(cartList.length);   //previous length of classList array

    let indexofClickedItemInCartList = cartList.findIndex((value)=> value.id == productId);    //finds the index of the object (element) whose id == the id passed as a param to the function addProductToCart()
    console.log(indexofClickedItemInCartList);

                if(indexofClickedItemInCartList < 0){    //the index of the item < 0, tells us that the item is not in the cart
                    cartList.push({                           // so we push it into the cart
                        id : productId,
                        quantity : 1
                    }) 
                    // console.log("this is the first item of this object");
                }
                else{   //else it is int the cart. So we increment its quantity if clicked again
                    // console.log("The item is already in cart"); 
                    cartList[indexofClickedItemInCartList].quantity = cartList[indexofClickedItemInCartList].quantity +  1;
                }
    console.log(cartList.length);  //present length of cartList array
    displayCartListToUI()
}


// adding click event listener to products in menu and dishes container
menuList_container.addEventListener("click", clickHandler)
dishesList_container.addEventListener("click", clickHandler )


// LocalStorage to save MenuFOods and DishesFoods locally in the web browser
function setLocalStorage(){
    let variable;
    fetch('dishes.json')
    .then(promiseObj => promiseObj.json())
    .then(data => {
        variable = data;
        console.log(variable);
        // stringVariable = JSON.stringify(variable)
        // console.log(stringVariable);
        localStorage.setItem('dishes', variable);
    })
    
    
    // return false;
    
}
setLocalStorage();

// retrieve local storage
const getLocalStorage = function(){
    let container = localStorage.getItem('dishes');
    // container = JSON.parse(container);
    // why does this commented line print null to the console
    console.log(container);
    return JSON.parse(container);
}
getLocalStorage();

localStorage.clear();

// pushing to cart.html from index.html from local storage
let cartListUIcontainer = document.querySelector(".cartBox")
console.log(cartListUIcontainer); 

function displayCartListToUI(){

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

        // cartListUIcontainer.innerHTML = newLiInCartList;
        container.innerHTML = newLiInCartList;
}

