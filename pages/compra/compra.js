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
            window.location.href = "carrito.php";
        }else{
            res.json().then((json) => console.log(json));
        }
    });
}