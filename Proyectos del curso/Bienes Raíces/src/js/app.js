function changeClass(node, oldClass = "", newClass = "") {
    node.classList.remove(oldClass);
    node.classList.add(newClass);
}
function darkTheme() {
    const themeButton = document.querySelector('.theme__button .icon');
    const themeCheck = document.querySelector('.theme__button .checkbox');
    const systemPreferences = window.matchMedia('(prefers-color-schema: dark)');
    if(systemPreferences) {
        document.body.classList.add('dark');
    };
    systemPreferences.addEventListener('change', () => {
        document.body.classList.toggle('dark');
    }) ;

    themeButton.addEventListener('click', () => {
        if(!themeCheck.checked) {    
            changeClass(themeButton, 'fa-sun', 'fa-moon');
            themeCheck.checked = true;
            document.body.classList.add('dark');
        } else {
            changeClass(themeButton, 'fa-moon', 'fa-sun');
            themeCheck.checked = false;
            document.body.classList.remove('dark');
        }
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

function app() {
    showResponsiveMenu();
    darkTheme();
}

window.addEventListener('load', () => {
    app();
});