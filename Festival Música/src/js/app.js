//== GALLERY ==//
function showImage(id) {
    const body = document.querySelector('body')
    function appendChild(box, [...childs]) {
        [...childs].forEach( e => {
            box.appendChild(e);
        })
    };
    function onClickRemoveOverlay(box, [...childs]) {
        [...childs].forEach( e => {
            e.addEventListener('click', function() {
                body.classList.remove('fixed');
                box.remove();    
            })
        })
    };
    // Creando el overlay
    const overlay = document.createElement('DIV');
    overlay.classList.add('overlay');
    // Creando la imagen
    const img = document.createElement('picture');
        img.innerHTML = `
            <source srcset="build/img/grande/${id}.avif" type="image/avif">
            <source srcset="build/img/grande/${id}.webp" type="image/webp">
            <img loading="lazy" src="build/img/grande/${id}.jpg" alt="Imagen Vocalista Festival">
        `;
    // Creando botón para cerrar overlay
    const btnClose = document.createElement('DIV');
    btnClose.textContent = 'X';
    btnClose.classList.add('btn-close-overlay');
    // Añadiendo img y btnClose al overlay
    appendChild(overlay, [img, btnClose]);
    // Proporcionar eventos a btnClose y overlay
    onClickRemoveOverlay(overlay, [btnClose, overlay]);
    // Añadiendo el overlay al body
    body.appendChild(overlay);
    body.classList.add('fixed');
}
function createGallery() {
    const gallery = document.querySelector('.gallery__images');
    // Creando imágenes
    for (let i = 1; i <= 12; i++) {
        const img = document.createElement('picture');
        img.innerHTML = `
            <source srcset="build/img/thumb/${i}.avif" type="image/avif">
            <source srcset="build/img/thumb/${i}.webp" type="image/webp">
            <img loading="lazy" src="build/img/thumb/${i}.jpg" alt="Imagen Vocalista Festival">
        `;
        img.addEventListener('click', () => showImage(i));
        
        gallery.appendChild(img);
    };
};


//== SCROLL AND FIXED HEADER ==//
function scrollNav() {
    const bar = document.querySelector('.header');
    const aboutFestival = document.querySelector('.about-festival');
    const body = document.querySelector('body');
    window.addEventListener('scroll', () => {
        if(aboutFestival.getBoundingClientRect().bottom < 0) {
            bar.classList.add('header-fixed');
            body.classList.add('body-isHeaderFixed');
        } else {
            bar.classList.remove('header-fixed');
            body.classList.remove('body-isHeaderFixed');
        }
    })
}


// Inicio de la app
function appInit() {
    createGallery();
    scrollNav();
};
document.addEventListener('DOMContentLoaded', () => {
    appInit();
});