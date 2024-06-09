const form = document.querySelector("form");
const continueButton = document.querySelector("[type='submit']");
const errorText = document.querySelector(".error-txt");

form.onsubmit = (e) => e.preventDefault();

continueButton.onclick = () => {
    let xhr = new XMLHttpRequest();
    xhr.open("POST", "./php/login.php");
    xhr.onload = () => {
        if (xhr.readyState === XMLHttpRequest.DONE) {
            if (xhr.status === 200) {
                let data = xhr.response;
                console.log(data);
                console.log(data)
                if (data == "success") {
                    location.href = "users.php";
                } else {
                    errorText.style.display = "block";
                    errorText.textContent = data;
                }                
            }
        }
    }
    let formData = new FormData(form);
    xhr.send(formData);
}