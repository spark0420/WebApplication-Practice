const form = document.querySelector(".typing-area"),
inputField = form.querySelector(".input-field"),
sendBtn = form.querySelector("botton"),
chatBox = document.querySelector(".chat-box");

form.onsubmit = (e) => {
    e.preventDefault(); // To prevent form from submitting
}

sendBtn.onclick = ()=>{
        //The XML object model is a collection of objects that you use to access and manipulate the data stored in an XML document. 
        let xhr = new XMLHttpRequest(); //creating XML object

        //xhr.open takes many parameters but we only pass
        //method, url, and async
        xhr.open("POST", "php/insert-chat.php", true);
        xhr.onload = () =>{
            if(xhr.readyState == XMLHttpRequest.DONE){
                if(xhr.status == 200){
                    inputField.value = "";//once message inserted into database, make the input field empty
                    scrollToBottom();
                }
            }
        }
        //sending the form data through ajax to php
        //create new formdata object
        let formData = new FormData(form);
        //sending the form data to php
        xhr.send(formData);
}

//To stop scrolling down every 500ms
chatBox.onmouseenter = () =>{
    chatBox.classList.add("active");
}
chatBox.onmouseenter = () =>{
    chatBox.classList.remove("active");
}

setInterval(() => {
    let xhr = new XMLHttpRequest(); //creating XML object

    //xhr.open takes many parameters but we only pass
    //method, url, and async
    xhr.open("POST", "php/get-chat.php", true);
    xhr.onload = () =>{
        if(xhr.readyState === XMLHttpRequest.DONE){
            if(xhr.status === 200){
                let data = xhr.response;
                chatBox.innerHTML = data;
                
                if(!chatBox.classList.contains("active")){
                    scrollToBottom();
                }
            }
        }
    }

    let formData = new FormData(form);
    xhr.send(formData);
}, 500); //runs every 500ms

function scrollToBottom(){
    chatBox.scrollTop = chatBox.scrollHeight;
}