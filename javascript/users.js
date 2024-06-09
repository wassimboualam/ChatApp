const searchBar = document.querySelector(".search input");
const searchButton = document.querySelector(".search button");
const usersList = document.querySelector(".users-list");


searchButton.onclick = () => {
    searchBar.classList.toggle("active");
    searchButton.classList.toggle("active");
    searchBar.focus();
}

let searchTerm;

searchBar.onkeyup = () => {
    searchTerm = searchBar.value;
    let xhr = new XMLHttpRequest();
    xhr.open("POST", "./php/search.php");
    xhr.onload = () => {
        if (xhr.readyState === XMLHttpRequest.DONE) {
            if (xhr.status === 200) {
                let data = xhr.response;
                usersList.innerHTML = data;
            }
        }
    }
    xhr.setRequestHeader("Content-type","application/x-www-form-urlencoded");
    xhr.send("searchTerm="+searchTerm);
} 

const interval = setInterval(() => {
    if (searchTerm) return;
    let xhr = new XMLHttpRequest();
    xhr.open("GET", "./php/users.php");
    xhr.onload = () => {
        if (xhr.readyState === XMLHttpRequest.DONE) {
            if (xhr.status === 200) {
                let data = xhr.response;
                usersList.innerHTML = data;
            }
        }
    }
    xhr.send();
}, 500);