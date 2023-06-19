function showPassword() {
    const iconBox = document.querySelector('.icon');
    const icon = document.querySelector('.icon .eye');
    const input = document.querySelector('#password');
    if(iconBox !== null) {
        iconBox.addEventListener('click', () => {
            if(input.type === "password") {
                input.type = "text";
                icon.classList.remove('fa-eye-slash');
                icon.classList.add('fa-eye');
            } else {
                input.type = "password";
                icon.classList.remove('fa-eye');
                icon.classList.add('fa-eye-slash');
            }
            input.focus();
        })
    }
}



function app() {
    showPassword();
}

window.onload = app;