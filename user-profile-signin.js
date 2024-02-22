


//form validation

let userSigninForm = document.querySelector("form");

// console.log(userSigninForm);

let phoneInput = userSigninForm['enterNumber'];
let smallTag = document.querySelector("#smallTag");
// console.log(phoneInput);

phoneInput.addEventListener("keydown", ()=>{
    let inputValue = phoneInput.value;
    console.log(inputValue);
    console.log(typeof inputValue);
    console.log(inputValue.length);
    phoneInput.classList.add("error")
    if( inputValue == "09036557354"){  //why does the value 09036557354 need an extra digit to activate the success class
        console.log(inputValue);
        // phoneInput.classList.remove("error")
        phoneInput.classList.add("success");
        smallTag.innerHTML =""

    }
    else{
        phoneInput.classList.remove("success");
        phoneInput.classList.add("error");
        smallTag.innerHTML = `Phone number must be at least 6 digits**`
  
    }
})



