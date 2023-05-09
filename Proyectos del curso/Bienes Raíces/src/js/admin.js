function validate(data) {
    result = false;
    if(data != '' && data != '@') result = true; else result = false;
    return result;
}
function checkInputs() {
    const inputs = [
        ...document.querySelectorAll('.input input'),
        document.querySelector('.input textarea')
    ];
    inputs.forEach(e => {
        e.addEventListener('input', () => {
            console.log(typeof e.value);
            if(validate(e.value)) {
                e.classList.add('validate');
            } else {
                e.classList.remove('validate');
            }
        })
    });

}


function admin() {
    checkInputs();
}

document.addEventListener('load', () => {
    admin();
})