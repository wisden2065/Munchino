

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



const productContainer = document.getElementById("dishes-container"); 
// console.log(productListTag);   
let productList = [];    

//create a function tha populates the empty array productList-----in this function we we call the function that displays List
const populateFoodList =()=>{

    fetch("products.json")  //fetch food data from products.json file 
    .then(promiseObj => promiseObj.json())   // the fetch() returns an object which is a promise
    .then((data) => {productList = data;
        console.log(data);
        displayFoodData();   //calling the fn to add list to UI

    }); 
}

populateFoodList();

function displayFoodData(){   
    productContainer.innerHTML = "";
    if(productList.length > 0){
        productList.forEach(product=>{

            let newProduct = document.createElement("div");
            newProduct.classList.add("box")
            newProduct.innerHTML = `<img src="${product.image}" alt="">
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
                                        </div>`
            productContainer.appendChild(newProduct); //code resulted into a bug when this line was placed after the forEach loop
        })
        
    }
  
    }


























//Add to cart section

let cartList = [];         //setting cart to be an empty list
let totalItems = 0;          //value of total products at span to zero

 

let allCartBtn = document.querySelectorAll(".btn"); //getting all buttons to attach an eventListener

    allCartBtn.forEach((btn)=>{
        btn.addEventListener("click", function addToCart(id, image, foodName, amount){  

                cartList.push({id, image, foodName, amount});
                totalItems = totalItems + amount;


                updateCartDisplay();
        });
    });

    function updateCartDisplay(){
        let cartUl = document.getElementById("cart-ul");
        console.log("in updateCartDisplay function");
        // clear previous content of the ul
        // cartUl.innerHTML = "";

        html = "";
     
        cartList.forEach((updatedCart)=>{
            let newLi = document.createElement("li");
            // newLi.innerText = ``
             html += `
            <div class="cart-container" id="">
            <div class="product-div"><img src="" alt=""></div>
            <div class="product-desc">
            <div class="product-wrapper">
                <h3>${updatedCart.foodName}</h3>
                <p>Just food</p>
            </div>
            </div>
            <div class="price-per-qty">
            <div class="price-wrapper">
                <p>Individualy</p>
                <span>Now $${updatedCart.amount}</span>
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
                <span>$${updatedCart.amount}</span>
            </div>
            </div>
        </div>`;

        newLi.innerHTML = html;
        // spanTotal = total;
        })

        cartUl.appendChild(newLi)
    }


        


        
    



    
