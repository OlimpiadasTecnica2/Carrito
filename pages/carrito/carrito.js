function update_sum(){
  var total = document.getElementById("total");
  var subtotal = document.getElementById("subtotal");

  var t = 0;
  var st = 0;
  for(const p of productos){
    t += p.precio * p.cantidad;
    st += p.precio;
  }
  total.innerHTML = t;
  subtotal.innerHTML = st;
}

function mod(ref, dif,id){
  const cant = ref.parentElement.getElementsByClassName('cant')[0];
  var cantidad = 0;
  var index = 0;
  for (const [i,p] of productos.entries())
{
  if (p.id == id){
    cantidad = p.cantidad;
    index = i;
    break;
  }
}
  cantidad += dif;
  if (cantidad < 0){
    return;
  }
  productos[index].cantidad = cantidad;
  fetch ('api/carrito.php',
    {
      method: "PUT",
      headers: {'content-type': 'application/json'},
      body: JSON.stringify({
        'cantidad': cantidad,
        'producto_id': id,
      })
    }
  ).then((res) => res.json()).then((json) => console.log(json)); 
  cant.innerHTML = cantidad;

  update_sum();
}

function factura(json){
  const factura = document.getElementById("factura");
  const text = document.createTextNode(json.mensaje);
  factura.classList = ["factura_st"];
  factura.appendChild(text);
}

function generar_factura(){
  fetch('api/comprar.php',{
    method: "GET",
    headers: {"content-type": "application/json"},
  }).then((res) => {
    if (res.ok){
      res.json().then((json) => factura(json));
    }
    else{
      res.json().then((json) => alert(json.mensaje));
    }
  });
}