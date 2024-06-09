const form = document.querySelector(".typing-area");
const sendBtn = form.querySelector("button");
const inputField = form.querySelector(".input");
const chatbox = document.querySelector(".chatbox");

form.onsubmit = (e) => {
    e.preventDefault();
}

sendBtn.onclick = () => {
    let xhr = new XMLHttpRequest();
    xhr.open("POST", "./php/insert-chat.php");
    xhr.onload = () => {
        if (xhr.readyState === XMLHttpRequest.DONE) {
            if (xhr.status === 200) {
                let data = xhr.response;
                console.log(data);
                inputField.value = "";
                scrollToBottom();
            }
        }
    }
    let formData = new FormData(form);
    xhr.send(formData);
}

let firstTime = true;

setInterval(() => {
    let xhr = new XMLHttpRequest();
    xhr.open("POST", "./php/get-chat.php");
    xhr.onload = () => {
        if (xhr.readyState === XMLHttpRequest.DONE) {
            if (xhr.status === 200) {
                let data = xhr.response;
                chatbox.innerHTML = data;

                if (firstTime) { // scroll down only on the first time
                    firstTime = false;
                    scrollToBottom();
                }
            }
        }
    }
    let formData = new FormData(form);
    xhr.send(formData);
}, 500);


function scrollToBottom() {
    chatbox.scrollTop = chatbox.scrollHeight;
}