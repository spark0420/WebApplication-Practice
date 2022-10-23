//sending signup form using javascript ajax to php
const form = document.querySelector(".signup form"),
continueBtn = form.querySelector(".button input"),
errorText = form.querySelector(".error-text");

form.onsubmit = (e) =>{
    //prevents form from submitting
    e.preventDefault();
}

continueBtn.onclick = () => {
    //creates a XML object
    let xhr = new XMLHttpRequest();
    //xhr.open() takes many params but we only pass method, url, and async
    //think about TCP webserver
    xhr.open("POST", "php/signup.php", true);
    xhr.onload = () => {
        if(xhr.readyState === XMLHttpRequest.DONE){
            if(xhr.status === 200){
                let data = xhr.response;
                if(data == "success"){
                    location.href = "users.php";
                }else{
                    errorText.textContent = data;
                    errorText.style.display = "block";
                }
            }
        }
    }
    let formData = new FormData(form);
    xhr.send(formData); //sends the form data to php
}
