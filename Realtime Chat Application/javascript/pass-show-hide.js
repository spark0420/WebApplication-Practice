// This js file is for password show and hide toggling

const pswrdField = document.querySelector(".form input[type='password']"),
toggleBtn = document.querySelector(".form .field i");

// onclick function -> syntax: object.onclick = function(){myScript};
toggleBtn.onclick = () =>{
    if(pswrdField.type == "password"){
        pswrdField.type = "text";
        toggleBtn.classList.add("active");
    }else{
        pswrdField.type = "password";
        toggleBtn.classList.remove("active");
    }
}

