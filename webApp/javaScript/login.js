const form = document.querySelector(".login form"),
  continueBtn = form.querySelector(".button input"),
  errorText = form.querySelector(".error-text");

form.onsubmit = (e) => {
  e.preventDefault();
}

continueBtn.onclick = () => {
  let xhr = new XMLHttpRequest();
  xhr.open("POST", "php/login.php", true);
  // xhr.responseType = 'text';
  xhr.onload = () => {
    if (xhr.readyState === XMLHttpRequest.DONE) {
      if (xhr.status === 200) {

        let data = xhr.response;

        
        // console.log(data);
        // console.log(xhr.response == "x");

        if (data == true) {
          location.href = "users.php";
        } else {
          errorText.textContent = data;
          errorText.style.display = "block";
        }
   
        // if (data != 'true') {
        //   errorText.textContent = data;
        //   errorText.style.display = "block";
        // } else {
        //   location.href = 'users.php';
        // }

        // switch(data){
        //   case (data == 'true'):
        //     location.href = 'users.php';
        //   default:
        //     errorText.textContent = data;
        //     errorText.style.display = "block";
        // }
      }
    }
  }
  let formData = new FormData(form);
  xhr.send(formData);
}