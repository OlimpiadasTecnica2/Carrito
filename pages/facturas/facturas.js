function set_cant(ref,id_factura,id_producto,dif){
	if (facturas[id_factura][id_producto] + dif < 0){
		return;
	}
	fetch ('api/facturas.php',{
		method: "PUT",
		headers: {"content-type": "application/json"},
		body: JSON.stringify({
			'cantidad': facturas[id_factura][id_producto] + dif,
			'id_factura': id_factura,
			'producto_id': id_producto,
		}),
	}).then((res) => {
		if (res.ok){
			facturas[id_factura][id_producto] += dif;
			ref.parentElement.getElementsByClassName('cant')[0].innerHTML = facturas[id_factura][id_producto];;
		}
		else{
			res.json().then((json) => alert(json.mensaje));
		}
	})
}