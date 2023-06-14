function changeClass(node, oldClass = "", newClass = "") {
    node.classList.remove(oldClass);
    node.classList.add(newClass);
}
function darkTheme() {
    const themeButton = document.querySelector('.theme__button .icon');
    const themeCheck = document.querySelector('.theme__button .checkbox');
    const systemPreferences = window.matchMedia('(prefers-color-schema: dark)');
    function setDark() {
        changeClass(themeButton, 'fa-sun', 'fa-moon');
        themeCheck.checked = true;
        document.body.classList.add('dark');
    }
    function setLigth() {
        changeClass(themeButton, 'fa-moon', 'fa-sun');
        themeCheck.checked = false;
        document.body.classList.remove('dark');
    }
    if(systemPreferences.matches) setDark();
    systemPreferences.addEventListener('change', () => {
        if(systemPreferences) setDark();
        else setLigth();
    }) ;

    themeButton.addEventListener('click', () => {
        if(!themeCheck.checked) setDark();
        else setLigth();
    });
}
function showResponsiveMenu() {
    const nav = document.querySelector('.bar__nav');
    
    const menuButton = document.querySelector('.responsive__button');
    const menuCheck = document.querySelector('.responsive__button .checkbox');
    menuButton.addEventListener('click', () => {
        if(!menuCheck.checked) {
            changeClass(nav, 'bar__nav', 'bar__nav--responsive');
            menuCheck.checked = true;
        } else {
            changeClass(nav, 'bar__nav--responsive', 'bar__nav');
            menuCheck.checked = false;
        }
    });
}
function showContactMethodForm() {
    // Caja de contacto
    const contactoBox = document.querySelector('#contacto');
    console.log(contactoBox);
    // input type = "radio";
    const metodos = document.querySelectorAll('input[name="contacto"]');
    // funcion para mostrar método de contacto
    function showPanelContact(e) {
        if(e.target.value === "telefono") {
            contactoBox.innerHTML = `
                <div class="input">
                    <label class="input__label">
                        Telefono
                    </label>
                    <input type="tel" class="telefono" name="contacto_telefono">
                </div>
            `;
        }
        else if(e.target.value === "email") {
            contactoBox.innerHTML = `
                <div class="input">
                    <label class="input__label">
                        Email
                    </label>
                    <input type="email" class="email" name="contacto_email">
                </div>
            `;
        }
    }
    metodos.forEach( e => {
        e.addEventListener('click', showPanelContact);
    })
}

function app() {
    showResponsiveMenu();
    darkTheme();
    showContactMethodForm();
}

window.addEventListener('DOMContentLoaded', () => {
    app();
})
