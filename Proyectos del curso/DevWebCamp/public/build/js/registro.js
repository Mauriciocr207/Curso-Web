(()=>{let e=[];const t=document.querySelector("#registro-bar-resumen");if(t){document.querySelectorAll(".evento__agregar").forEach(e=>e.addEventListener("click",n));function n(t){e.length<5?(t.target.disabled=!0,e=[...e,{id:t.target.dataset.id,titulo:t.target.parentElement.querySelector(".evento__nombre").textContent}]):Swal.fire({title:"Sólo un máximo de 5 eventos",icon:"warning"}),o()}function o(){if(function(){for(;t.firstChild;)t.removeChild(t.firstChild)}(),e.length>0)e.forEach(n=>{const r=document.createElement("DIV");r.classList.add("registro-bar__evento");const a=document.createElement("H3");a.classList.add("registro-bar__nombre"),a.textContent=n.titulo;const i=document.createElement("BUTTON");i.classList.add("registro-bar__eliminar"),i.innerHTML='<i class="fa-solid fa-trash"></i>',i.onclick=function(){!function(t){e=e.filter(e=>e.id!=t);document.querySelector(`[data-id="${t}"]`).disabled=!1,o()}(n.id)},r.append(a,i),t.appendChild(r)});else{const e=document.createElement("P");e.textContent="No hay eventos, añade hasta 5 del lado izquierdo ",e.classList.add("registro-bar__texto"),t.appendChild(e)}}document.querySelector("#registro").addEventListener("submit",(async function(t){t.preventDefault();const n=document.querySelector("#regalo").value,o=e.map(e=>e.id);if(0===o.length||""===n)Swal.fire({title:"Elige al menos un Evento y un regalo",icon:"warning"});else{const e=new FormData;e.append("id_eventos",o),e.append("id_regalo",n);const t="/finalizar-registro/conferencias",r=await fetch(t,{method:"POST",body:e});(await r.json()).res?Swal.fire({title:"Tus conferencias se han almacenado y tu registro fue exitoso.\n Te esperamos en DevWebCamp",icon:"success"}):Swal.fire({title:"Hubo un error",icon:"error"})}})),o()}})();
//# sourceMappingURL=registro.js.map
