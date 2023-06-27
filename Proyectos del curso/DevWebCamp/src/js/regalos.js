(() => {
    
    
    const ctx = document.getElementById('myChart');
    if(ctx) {
        async function obtenerDatos() {
          const url = "/api/regalos";
          const response = await fetch(url);
          const result = await response.json();

          const labels = result.map(regalo => regalo.nombre);
          const data = {
            labels: labels,
            datasets: [{
              label: 'My First Dataset',
              data: result.map(regalo => regalo.total),
              backgroundColor: [
                'rgba(255, 99, 132, 0.2)',
                'rgba(255, 159, 64, 0.2)',
                'rgba(255, 205, 86, 0.2)',
                'rgba(75, 192, 192, 0.2)',
                'rgba(54, 162, 235, 0.2)',
                'rgba(153, 102, 255, 0.2)',
                'rgba(201, 203, 207, 0.2)'
              ],
              borderColor: [
                'rgb(255, 99, 132)',
                'rgb(255, 159, 64)',
                'rgb(255, 205, 86)',
                'rgb(75, 192, 192)',
                'rgb(54, 162, 235)',
                'rgb(153, 102, 255)',
                'rgb(201, 203, 207)'
              ],
              borderWidth: 1
            }]
          };
          const config = {
            type: 'bar',
            data: data,
            options: {
              scales: {
                y: {
                  beginAtZero: true
                }
              }
            },
            maintainAspectRatio: false,
            responsive: true,
            aspectRatio: 1 / 1
          };
          const chart = new Chart(ctx, config);
          window.addEventListener('resize', () => {
              chart.resize();
          });
            
        }
        obtenerDatos();
        
    }
    
})();