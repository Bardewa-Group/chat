const form = document.querySelector('.typing-area'),
    inputfield = form.querySelector('.input-field'),
    sendBtn = form.querySelector('button'),
    chatBox = document.querySelector('.chat-box');

form.onsubmit = (e) => {
    e.preventDefault();
}

sendBtn.onclick = () => {
    // starting ajax for signup
    let xhr = new XMLHttpRequest();
    xhr.open('POST', 'php/insert-chat.php', true);
    xhr.onload = () => {
        if (xhr.readyState === XMLHttpRequest.DONE) {
            if (xhr.status === 200) {
                inputfield.value = '';
                scrollToBottom();
            }
        }
    }
    // we are going to send the form data from ajax into php
    let formData = new FormData(form);

    xhr.send(formData); // this send the data to php file for processing 
}

chatBox.onmouseenter = ()=>{
    chatBox.classList.add('active');
}
chatBox.onmouseleave = ()=>{
    chatBox.classList.remove('active');
}

setInterval(() => {

    // starting ajax for signup
    let xhr = new XMLHttpRequest();
    xhr.open('POST', 'php/get-chat.php', true);
    xhr.onload = () => {
        if (xhr.readyState === XMLHttpRequest.DONE) {
            if (xhr.status === 200) {
                let data = xhr.response;
                chatBox.innerHTML = data;
                if(!chatBox.classList.contains('active')){
                    scrollToBottom();
                }
            }
        }

    }
    // we are going to send the form data from ajax into php
    let formData = new FormData(form);

    xhr.send(formData); // this send the data to php file for processing 
}, 500);

// scrolling chat to bottom
function scrollToBottom(){
    chatBox.scrollTop = chatBox.scrollHeight;
}