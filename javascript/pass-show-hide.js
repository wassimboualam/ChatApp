const passwordField = document.querySelector("[type='password']");
const toggleButton = document.querySelector("i.fa-eye");


toggleButton.onclick = () => {
    if (passwordField.type === "password") {
        passwordField.type = "text";
    } else {
        passwordField.type = "password";        
    }
    toggleButton.classList.toggle("active");

}