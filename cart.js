
let cartContainer = document.querySelector("#cart_ul");
let cartBox = document.querySelector(".cart-box");           //get a ref to the htmlElement with the id cart_ul, which will be populated with the function [addToCart()]
let spanCounter = document.getElementById("cartTotal");                //get a ref to the span for number of items

console.log(cartContainer);  //nul
console.log(cartBox);       //null
console.log(spanCounter); 




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
        productList.forEach(product=>{   

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
                                        productContainerInIndex.innerHTML = html;  //sets the generated HTML to the div(productContainer)
       
                                        // productContainer.appendChild(newProduct); //code resulted into a bug when this line was placed after the forEach loop

                                        // console.log("In the loop");
        })
        
    }
  
    }


//adding a general eventListener on the productContainer that houses individual food Object



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

        let cartListWrapper = document.querySelector(".ulForCart");
        console.log(cartListWrapper);
    
        let newLiInCartList = document.createElement("li");
        console.log(newLiInCartList);

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

// let allCartBtn = document.querySelectorAll(".btn"); //getting all buttons to attach an eventListener

//     allCartBtn.forEach((btn)=>{
//         btn.addEventListener("click", function addToCart(id, image, foodName, amount){  
//             console.log("I have clicked");
//                 cartList.push({id, image, foodName, amount});
//                 totalItems = totalItems + amount;


//                 updateCartDisplay();
//         });
//     });

//     function updateCartDisplay(){
//         let cartUl = document.getElementById("cart-ul");
//         console.log("in updateCartDisplay function");
//         // clear previous content of the ul
//         // cartUl.innerHTML = "";

//         html = "";
     
//         cartList.forEach((updatedCart)=>{
//             let newLi = document.createElement("li");
//             // newLi.innerText = ``
//              html += `
//             <div class="cart-container" id="">
//             <div class="product-div"><img src="" alt=""></div>
//             <div class="product-desc">
//             <div class="product-wrapper">
//                 <h3>${updatedCart.foodName}</h3>
//                 <p>Just food</p>
//             </div>
//             </div>
//             <div class="price-per-qty">
//             <div class="price-wrapper">
//                 <p>Individualy</p>
//                 <span>Now $${updatedCart.amount}</span>
//             </div>
//             </div>
//             <div class="remove-item">
//             <div class="del-wrapper">
//                 <svg class="w-6 h-6 text-gray-800 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
//                 <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.2" d="M5 7h14m-9 3v8m4-8v8M10 3h4a1 1 0 0 1 1 1v3H9V4a1 1 0 0 1 1-1ZM6 7h12v13a1 1 0 0 1-1 1H7a1 1 0 0 1-1-1V7Z"/>
//                 </svg>
//             </div>
//             </div>
//             <div class="shop-cart">
//             <div class="cart-wrapper">
//                 <span class="add" ><svg class="w-6 h-6 text-gray-800 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
//                 <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 12h14"/>
//                 </svg></span>
//                 <span id="amount">2</span>
//                 <span class="minus"><svg class="w-6 h-6 text-gray-800 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
//                 <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 12h14m-7 7V5"/>
//                 </svg></span>
//             </div>
//             </div>
//             <div class="sum">
//             <div class="sum-wrapper">
//                 <span>$${updatedCart.amount}</span>
//             </div>
//             </div>
//         </div>`;

//         newLi.innerHTML = html;
//         // spanTotal = total;
//         })

//         cartUl.appendChild(newLi)
//     }


        
 

        
    



    
// 


