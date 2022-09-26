const form = document.querySelector(".signup form"),
continueBtn = form.querySelector(".button input"),
errorText = form.querySelector(".error-text");

form.onsubmit = (e) => {
    e.preventDefault(); // To prevent form from submitting
}
continueBtn.onclick = () =>{
    //The XML object model is a collection of objects that you use to access and manipulate the data stored in an XML document. 

    let xhr = new XMLHttpRequest(); //creating XML object

    //xhr.open takes many parameters but we only pass
    //method, url, and async
    xhr.open("POST", "php/signup.php", true);
    xhr.onload = () =>{
        if(xhr.readyState == XMLHttpRequest.DONE){
            if(xhr.status == 200){
                let data = xhr.response;
                if(data == "success!"){
                    location.href="users.php";
                }else{
                    errorText.textContent = data;
                    errorText.style.display = "block";
                }
            }
        }

    }
    //sending the form data through ajax to php
    //create new formdata object
    let formData = new FormData(form);
    //sending the form data to php
    xhr.send(formData);
}