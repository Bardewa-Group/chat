const searchBar = document.querySelector(".users .search input"),
    searchBtn = document.querySelector(".users .search button"),
    userList = document.querySelector(".users .users-list");

searchBtn.onclick = () => {
    searchBar.classList.toggle("active");
    searchBar.focus();
    searchBtn.classList.toggle("active");
    searchBar.value = '';
}

searchBar.onkeyup = ()=>{
    let searchTerm = searchBar.value;
    
    if(searchTerm != ''){ // if user press button
        searchBtn.classList.add('active'); // add active
    }else{
        searchBtn.classList.remove('active'); // else remove
    }

    // starting of ajax
    let xhr = new XMLHttpRequest();
    xhr.open('POST', 'php/search.php', true);
    xhr.onload = () => {
        if (xhr.readyState === XMLHttpRequest.DONE) {
            if (xhr.status === 200) {
                let data = xhr.response;
                userList.innerHTML = data;
                
            }
        }
        
    }
    xhr.setRequestHeader('Content-type', 'application/x-www-form-urlencoded');
    xhr.send('searchTerm='+ searchTerm); // this send the data to php file for processing
}

setInterval(() => {

    // starting ajax for signup
    let xhr = new XMLHttpRequest();
    xhr.open('GET', 'php/users.php', true);
    xhr.onload = () => {
        if (xhr.readyState === XMLHttpRequest.DONE) {
            if (xhr.status === 200) {
                let data = xhr.response;
                // console.log(data);
                if(!searchBar.classList.contains('active')){  // if
                    userList.innerHTML = data;
                }

            }
        }
        
    }
    xhr.send(); // this send the data to php file for processing
}, 500);

