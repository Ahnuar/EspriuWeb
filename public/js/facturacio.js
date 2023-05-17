const mes = document.getElementById("mes");

mes.addEventListener("change", function() {
  const valorSeleccionat = mes.options[mes.selectedIndex].value;

  obtenerFacturacion(valorSeleccionat);
});

document.addEventListener('DOMContentLoaded',()=>{
  var fecha = new Date();

  var mesActual = fecha.getMonth() + 1;
  obtenerFacturacion(mesActual);
});

//FUNCION
function obtenerFacturacion(mes){
  var facturacionUrl = "obtenerFacturacion";
  $.ajax({
    url: facturacionUrl + mes,
    type: "GET",
    success: function(response) {

        const nodoAEliminar = document.getElementById("tbody");

        if (nodoAEliminar && nodoAEliminar.parentNode) {
          nodoAEliminar.parentNode.removeChild(nodoAEliminar);
        }

        var tbody = document.createElement('tbody');
        tbody.setAttribute('id', 'tbody');
        var tabla = $('.table');
        var precio = 0;
        response.forEach(fecha => {
                let fila           = document.createElement('tr');
                fila.innerHTML     = `
                    <td>${fecha.nombre}</td>
                    <td class="d-none d-md-inline-block">${fecha.apellidos}</td>
                    <td>${fecha.fecha}</td>
                    <td class="d-none d-md-inline-block">${fecha.hora_inicio}</td>
                    <td class="d-none d-md-inline-block">${fecha.hora_fin}</td>
                    <td>${fecha.Precio}</td>
                    `;
                    precio = precio + fecha.Precio;
                tbody.appendChild(fila);
          
        });
        let fila           = document.createElement('tr');
        fila.innerHTML     = `
                    <td></td>
                    <td class="d-none d-md-inline-block"></td>
                    <td></td>
                    <td class="d-none d-md-inline-block"></td>
                    <td class="d-none d-md-inline-block"></td>
                    <td>Total ${precio}€</td>
                    `;
        tbody.appendChild(fila);
        tabla.append(tbody);
    },
    error: function(xhr, status, error) {
        console.log('Error al obtener los datos');
    }
  });

}