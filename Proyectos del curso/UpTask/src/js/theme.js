(() => {
    // Set initial Theme
    const Themes = {
        dark: "dark",
        light: "light",
    };
    const body = document.querySelector('body');
    if(window.matchMedia('(prefers-color-scheme: dark)').matches) {
        body.classList.add(Themes.dark);
        setThemeBtn(Themes.dark);
    }
    function toggleTheme() {
        const themeBtn = document.querySelector('#themeBtn');
        (Themes.dark); 
        themeBtn.addEventListener('click', () => {
            body.classList.toggle('dark');
            if(body.classList.contains(Themes.dark)) {
                setThemeBtn(Themes.dark);
            } else {
                setThemeBtn(Themes.light);
            }
        })
    }
    function setThemeBtn(theme = Themes.light) {
        const themeBtn = document.querySelector('#themeBtn');
        const icon  = themeBtn.querySelector('.icon');
        const text = themeBtn.querySelector('.option-text');
        if(theme === Themes.dark) {
            icon.innerHTML = `<i class="fa-solid fa-moon"></i>`;
            text.textContent = "Dark";
        } else {
            icon.innerHTML = `<i class="fa-solid fa-sun"></i>`;
            text.textContent = "Light";
        }
    }

    function themeApp() {
        toggleTheme();
    }
    themeApp();
})();