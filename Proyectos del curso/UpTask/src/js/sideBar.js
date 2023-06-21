function sideBar() {
    // sidebar button
    const sideBarButton = document.querySelector('.sidebar-button');
    const checkbox = sideBarButton.querySelector('.hidden');
    const icon = sideBarButton.querySelector('i');
    // sidebar
    const sideBar = document.querySelector('.sidebar');
    sideBarButton.addEventListener('click', () => {
        if(checkbox.checked) {
            icon.style.transform = 'rotate(90deg)';
            sideBar.classList.add('colapsed');
            checkbox.checked = false;
        } else {
            icon.style.transform = 'rotate(-90deg)';
            checkbox.checked = true;
            sideBar.classList.remove('colapsed');
        }
    })
}
sideBar();