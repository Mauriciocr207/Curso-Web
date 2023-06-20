function showPassword() {
    const campos = document.querySelectorAll('.campo.w-password');
    console.log(campos);
    campos.forEach( campo => {
        const iconBox = campo.querySelector('.icon');
        const icon = campo.querySelector('.icon .eye');
        const input = campo.querySelector('.password');
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
    });
}
showPassword();