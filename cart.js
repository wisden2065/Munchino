

let cartBtn = document.querySelectorAll(".food"); //gets a NodeList of buttons (Add to cart)

const allFood = Array.from(cartBtn); //created a proper array from the NodeList of cartBtn

console.log(cartBtn);
// console.log(allFood);

allFood.forEach((food)=>{               // adding an event listener from the proper array
    food.addEventListener("click", function(foodClass){
        // console.log(`clicked on: ${food.innerHTML}`);  //prints Add to cart to the console

        const 
    })
})