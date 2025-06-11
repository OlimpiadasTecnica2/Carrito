function mod(ref, dif){
  const cant = ref.parentElement().getElementById('cant');
  var cantidad = number(cant.innerHTML);
  cantidad += dif;
  if (cantidad < 0){
    return;
  }
  fetch ('api/carrito.php',
    {
      method: "PUT",
      headers: {'content-type': 'application/json'},
      body: JSON.stringify({
        'cantidad': cantidad,
        'producto_id': ref.id,
      })
    }
  ).then((res) => res.json()).then((json) => console.log(json)); 
  cant.innerHTML = cantidad;
}