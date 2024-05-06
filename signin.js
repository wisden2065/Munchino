


//form validation

let signinForm = document.querySelector("form");

console.log(signinForm);

let phoneInput = signinForm['email'];
let smallTag = document.querySelector("#smallTag");
console.log(phoneInput);

phoneInput.addEventListener("keyup", ()=>{
    let inputValue = phoneInput.value;
    console.log(inputValue);

    phoneInput.classList.add("error")
    if( inputValue.includes('@gmail.com')){  //why does the value 09036557354 need an extra digit to activate the success class
        console.log(inputValue);
        // phoneInput.classList.remove("error")
        phoneInput.classList.add("success");
        phoneInput.classList.add("success");
        smallTag.innerHTML =""

    }
    else{
        phoneInput.classList.remove("success");
        phoneInput.classList.add("error");                            
        smallTag.innerHTML = `Invalid email. Must include @gmail.com**`
  
    }
})



