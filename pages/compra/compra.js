function post_carrito(id){
    fetch('api/carrito.php',{
        method: "POST",
        headers: {"content-type": "application/json"},
        body: JSON.stringify({
            'producto_id': id,
            'cantidad': 1,          
        })
    }).then((res) => {
        if (res.ok){
            alert("Producto agregado al carrito");
        }else{
            res.json().then((json) => alert(json.mensaje));
        }
    });
}