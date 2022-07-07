const form = document.querySelector(".signup form"),
    btn = form.querySelector('.button input'),
    errorText = form.querySelector('.error-text');


form.onsubmit = (e) => {
    e.preventDefault();
}

btn.onclick = () => {
    // starting ajax for signup
    let xhr = new XMLHttpRequest();
    xhr.open('POST', 'php/signup.php', true);
    xhr.onload = () => {
        if (xhr.readyState === XMLHttpRequest.DONE) {
            if (xhr.status === 200) {
                let data = xhr.response;

                if(data == true) {
                    location.href = 'users.php';
                }
                else{
                    errorText.textContent = data;
                    errorText.style.display = 'block';
                    
                }
            }
        }
    }
    // we are going to send the form data from ajax into php
    let formData = new FormData(form);

    xhr.send(formData); // this send the data to php file for processing
}

