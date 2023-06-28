(() => {
    const mapa = document.querySelector('#mapa');
    if(mapa) {
        const lat = 21.033610221907715;
        const long = -89.62932559786971;
        const zoom = 16;
        const map = L.map('mapa').setView([lat, long], zoom);

        L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', {
            attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
        }).addTo(map); 

        L.marker([lat, long]).addTo(map)
            .bindPopup(`
            <h2 class="mapa__heading">DevWebCamp</h2>
            <p class="mapa__descripcion">Centro de Convensiones Siglo XXI</p>
            `)
            .openPopup(); 
    }
})();