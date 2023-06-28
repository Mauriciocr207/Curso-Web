<div class="registro">
    <h2 class="registro__heading"><?php echo $titulo; ?></h2>
    <p class="registro__descripcion">
        Elige tu plan
    </p>
    <div class="paquetes__grid">
        <div class="paquete">
            <h3 class="paquete__nombre">Pase Gratis</h3>
            <ul class="paquete__lista">
                <li class="paquete__elemento">Acceso Virtual a DevWebCamp</li>
            </ul>
            <p class="paquete__precio">$0</p>
            <form action="/finalizar-registro/gratis" method="POST">
                <input class="paquetes__submit" type="submit" value="Inscripcion Gratis">
            </form>
        </div>
        <div class="paquete">
            <h3 class="paquete__nombre">Pase Presencial</h3>
            <ul class="paquete__lista">
                <li class="paquete__elemento">Acceso Presencial a DevWebCamp</li>
                <li class="paquete__elemento">Pase por 2 días</li>
                <li class="paquete__elemento">Acceso a Talleres y Conferencias</li>
                <li class="paquete__elemento">Acceso a las Grabaciones</li>
                <li class="paquete__elemento">Camisa del Evento</li>
                <li class="paquete__elemento">Comida y Bebida</li>
            </ul>
            <p class="paquete__precio">$199</p>
            <div id="smart-button-container">
                <div style="text-align: center; margin-top: 3rem;">
                    <div id="paypal-button-container-1"></div>
                </div>
            </div>
        </div>
        <div class="paquete">
            <h3 class="paquete__nombre">Pase Virtual</h3>
            <ul class="paquete__lista">
                <li class="paquete__elemento">Acceso Virtual a DevWebCamp</li>
                <li class="paquete__elemento">Pase por 2 días</li>
                <li class="paquete__elemento">Enlace a Talleres y Conferencias</li>
                <li class="paquete__elemento">Acceso a las Grabaciones</li>
            </ul>
            <p class="paquete__precio">$49</p>
            <div id="smart-button-container">
                <div style="text-align: center; margin-top: 3rem;">
                    <div id="paypal-button-container-2"></div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Script para el pago -->
<script src="https://www.paypal.com/sdk/js?client-id=<?php echo $_ENV["CLIENT_PAYPAL_ID"] ?>&enable-funding=venmo&currency=USD" data-sdk-integration-source="button-factory"></script>
<script>
    function initPayPalButton1() {
      paypal.Buttons({
        style: {
          shape: 'pill',
          color: 'black',
          layout: 'vertical',
          label: 'pay',
        },
 
        createOrder: function(data, actions) {
          return actions.order.create({
            purchase_units: [{"description":"1","amount":{"currency_code":"USD","value":199}}]
          });
        },
 
        onApprove: function(data, actions) {
          return actions.order.capture().then(function(orderData) {
                console.log(orderData.purchase_units[0].payments.captures[0].id);
                const datos = new FormData();
                datos.append('id_paquete', orderData.purchase_units[0].description);
                datos.append('id_pago', orderData.purchase_units[0].payments.captures[0].id);
                fetch('/finalizar-registro/pagar', {
                    method: 'POST',
                    body: datos,
                })
                .then( respuesta => respuesta.json() )
                .then( resultado => {
                    if(resultado.res) {
                        actions.redirect('http://devwebcamp.cm/finalizar-registro/conferencias');
                    }
                })
          });
        },
 
        onError: function(err) {
          console.log(err);
        }
      }).render('#paypal-button-container-1');
    }
    function initPayPalButton2() {
      paypal.Buttons({
        style: {
          shape: 'pill',
          color: 'blue',
          layout: 'vertical',
          label: 'pay', 
        },
 
        createOrder: function(data, actions) {
          return actions.order.create({
            purchase_units: [{"description":"2","amount":{"currency_code":"USD","value":49}}]
          });
        },
 
        onApprove: function(data, actions) {
          return actions.order.capture().then(function(orderData) {
                // console.log(orderData.purchase_units[0].payments.captures[0].id);
                const datos = new FormData();
                datos.append('id_paquete', orderData.purchase_units[0].description);
                datos.append('id_pago', orderData.purchase_units[0].payments.captures[0].id);
                fetch('/finalizar-registro/pagar', {
                    method: 'POST',
                    body: datos,
                })
                .then( respuesta => respuesta.json() )
                .then( resultado => {
                    if(resultado.res) {
                        actions.redirect('http://devwebcamp.cm/finalizar-registro/conferencias');
                    } else {
                      console.log(resultado);
                    }
                })
          });
        },
 
        onError: function(err) {
          console.log(err);
        }
      }).render('#paypal-button-container-2');
    }
    initPayPalButton1();
    initPayPalButton2();
</script>
