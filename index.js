
// adding functionality to search icon
let searchInput = document.getElementById("search-box");
console.log(searchInput);


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
let openSearchIcon = document.querySelector("#search-icon");
let searchIcon = document.getElementById("searchIcon")
let searchIconBox = document.querySelector("#search-icon-box");



openSearchIcon.onclick =()=>{
        // when the button is clicked, we show the search bar 
    searchIconBox.classList.toggle("activate");
    openSearchIcon.classList.toggle("fa-xmark");
       // then we the classList that has the visible search cancel available
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
    loop: true,
    speed: 2500, 
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

// function to search products
function searchFood(){
    let foodName = searchInput.value;
    if(foodName !== ""){
        // console.log(cartList2);

        // make a function to return filtered products on keypress
        // when we filter the movies, this returns a new array
        // let searchedFood = cartList2.filter((product)=>{
        //         console.log(product.foodName);
        //         return product.foodName.toUpperCase().includes(foodName.toUpperCase());
           
        // })
        // console.log(searchedFood); //outputs the array of food searched in the searchInput
        // pushMenuFoodListToUI(searchedFood); //pushes this array to the UI
        // call the function that will a request to search.php that will return filtered products on keypress with php
        callFilteredProduct(foodName);  //pass the value foodName to the this function
       

        
    }
    else{
        // display all the default product
        // pushMenuFoodListToUI(cartList2);
    }
}

let searchDropDown = document.querySelector(".searchDropDown");
// logs value of input to console onKeyup
searchInput.addEventListener("keyup", (e)=>{
    console.log(searchInput.value);
    let lengthValue = e.target.value.length;
    // create a list of dummy text for the dropdown
    let searchList = document.createElement("ul");
    let list = document.createElement("li");
    list.style.listStyleType = "none";
    list.style.backgroundColor = "#eee";
    searchDropDown.style.borderRadius = "30px";

        // remove all the contents in the dropDown as soon as there is nothing in the search bar
        if(e.target.value == ""){
            searchDropDown.innerHTML = "";
            // searchIconBox.classList.toggle("activate")
        }
        if(lengthValue > 2){
            for(let i = 0; i < 5; i++){
                list.innerHTML = e.target.value;
                searchList.appendChild(list);
            }
            searchDropDown.appendChild(searchList)
            
        }

})  
// toggle the class for searchInput box to change border-radius
searchInput.addEventListener("click", ()=>{
    searchIconBox.classList.toggle("change");
    // then populate the list in the searchInput with recent search of user stored locally
})



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

function pushMenuFoodListToUI(foodArray){   
    // let the display be blank as soon as this function is called  
    document.innerHTML = "";
        let html = '';
            foodArray.forEach((food)=>{
                html +=`<div class="box" id="${food.id}">
                            <div class="image">
                                <img src="${food.image}" alt="">
                            </div>
                            <div class="content">
                                <h3>${food.foodName}</h3>
                                <div><i class="fas fa-naira-sign">${food.amount}</i></div>
                                <a href="#" class="btn food" id="${food.id}">add to cart</a>
                            </div>
                        </div>`
            })
            menuList_container.innerHTML = html;
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

// function definition that will call the server search.php
function callFilteredProduct(foodName){

    fetch("search.php", 
      {
        method : "PUT",
        headers : {
            "Content-Type" : "application/json",
        },
        body : JSON.stringify({foodName}),
      }
    )
    .then((res)=>{
        console.log(res);
        return res.json();
    })
    .then((prod)=>{
        console.log(prod);
        console.log(prod['searchedProductList']);
    })
}