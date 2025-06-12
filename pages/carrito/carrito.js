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


function generar_factura(){
  const fc = document.getElementById("factura");
  if (fc.getElementsByClassName('item').length == 0){
    alert("No tiene productos");
    return;
  }
  const text = document.createTextNode("Cargando...");
  fc.appendChild(text);
  fc.classList = ["factura_st"];
  fetch('api/comprar.php',{
    method: "GET",
    headers: {"content-type": "application/json"},
  }).then((res) => {
    if (res.ok){
      res.json().then((json) => {
        fc.removeChild(text);
        fc.appendChild(document.createTextNode(json.mensaje));
        document.getElementById('car').replaceChildren(document.createTextNode("No tiene productos en el carrito"));
        document.getElementById('total').innerHTML = 0;
        document.getElementById('subtotal').innerHTML = 0;
      });
    }
    else{
      res.json().then((json) => alert(json.mensaje));
    }
  });
}