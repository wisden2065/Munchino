
// getting the search icon
let searchInput = document.getElementById("search-box");
console.log(searchInput);
let typedValue = searchInput.value;
let lengthValue = searchInput.value.length;
// get the div containing all the navigation icons
let navbar = document.querySelector(".navbar");
//get all the buttons in navbar to toggle class which has the green color -- onCLick
let allBtn = document.querySelectorAll(".navbar a")

allBtn.forEach((activeBtn) => { 
  activeBtn.addEventListener("click", ()=>{
    allBtn.forEach((e)=> e.classList.remove("active"));
    activeBtn.classList.add("active");
  })
});

// get the hamburger icon for menu-list and add functionality to hide and show the tab
let menu = document.querySelector("#menu-list-icon");

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
    // searchDropDown.classList.toggle("remove");
       // then we the classList that has the visible search cancel available
}
// get the ul on picture to active dropdown onclick
let picture = document.querySelector(".profile");
let pictureDropdown = document.querySelector(".dropdown-menu");
picture.addEventListener("click", ()=>{
    // toggle to change the ul class
    pictureDropdown.classList.toggle("active");
    console.log("TOGGLING");
})

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

// get the div to display the result of product search
let searchDropDown = document.querySelector(".searchDropDown");

// create a list for the the product result for search query
let searchList = document.createElement("ul");
let list = document.createElement("li");
list.style.listStyleType = "none";

// listen to keypress in the search bar and run product search query
searchInput.addEventListener("keyup", (e)=>{
    let typedValue = e.target.value;
    console.log(typedValue);
    let lengthValue = e.target.value.length;

        // remove all the contents in the dropDown as soon as there is nothing in the search bar
        if(typedValue.length == 0){
            list.innerHTML = "";
            searchDropDown.innerHTML = "";
            searchDropDown.classList.toggle("remove");
        }

        console.log(lengthValue);
        // if the length of the product the user inputs is an even number, make a query to db to fetch product
        if(lengthValue % 2 === 0){
            console.log(lengthValue);
                // list.innerHTML = typedValue;
                // searchList.appendChild(list);
                // console.log(searchList);
                // searchDropDown.appendChild(searchList);
                // call fetch function
                getSearchedProduct(typedValue, e);
        }
    })

        

// function to get searched Products definition that will call the server search.php
function getSearchedProduct(foodName, e){
    console.log("In the getSearchedProduct function");

    fetch(`search.php?food=${foodName}`, 
      {
        method : "GET",
        headers : {
            "Content-Type" : "application/json",
        },
        // body : JSON.stringify({foodName}),
      }
    )
    .then((res)=>{
            console.log(res);
            return res.json();
    })
    .then((prod)=>{
        console.log(prod);
        console.log(prod['foundProducts']);
        return prod['foundProducts'];
    })
    .then((result)=>{
        if(result !== "empty"){
            displaySearchProduct(result, e);
        }
        else{
            // displaySearchProduct()
            console.log("Product nut found");
            // call the function to show that product not found
            displayProductNotFound(result);

        }
    })
    .catch((error)=>{
        // call the function that will display the list items and pass the error message to it
        console.error(error)
    })

}
// function to display searched products
function displaySearchProduct(foodList, e){
    // let searchList = document.createElement("ul");
    // let typedValue = e.target.value;
    // let lengthValue = e.target.value.length;
    // searchDropDown.style.borderRadius = "30px";
    console.log(foodList, 'AND ', e);
    // loop though the array of food returned from the search query and insert each into the list in the dropdown
//    if(foodList !== ""){
        foodList.forEach((food)=>{
            let list = document.createElement("li");
            list.style.listStyleType = "none";
            list.style.backgroundColor = "#eee";
            list.style.padding = "5px";
            
                list.innerHTML = food;
                searchList.appendChild(list);
                console.log(searchList);
                searchDropDown.appendChild(searchList);
                // call fetch function
        })
   }
 
function displayProductNotFound(){
            list.style.listStyleType = "none";
            list.style.backgroundColor = "#eee";
            list.style.padding = "5px";
    list.innerHTML = "Product not Found";
    searchList.appendChild(list);
    console.log(searchList);
    searchDropDown.appendChild(searchList);
}

// toggle the class for searchInput box to change border-radius
searchInput.addEventListener("click", ()=>{
    // searchIconBox.classList.toggle("change");
    // then populate the list in the searchInput with recent search of user stored locally
})


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
// menuList_container.addEventListener("click", clickHandler)
// dishesList_container.addEventListener("click", clickHandler )

