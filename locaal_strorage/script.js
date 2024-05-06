







function saveProduct(){
    localStorage.setItem('product', `{productName:'Rice'}`)
}



function retrieveScore(){

  const myScore=  localStorage.getItem('score');

  document.querySelector('p').innerHTML= myScore;

}

function getProduct(){

    const product=  localStorage.getItem('product');
console.log(product)
  }