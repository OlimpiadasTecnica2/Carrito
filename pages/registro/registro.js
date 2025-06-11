document.getElementById("formulario").onsubmit = function(event) {
	event.preventDefault();
  
	let password = document.getElementById("password");
	let confirmPassword = document.getElementById("confirmPassword").value;
  
	if (password.value !== confirmPassword) {
	  alert("Las contraseñas no coinciden.");
	  return;
	}

	const titular = document.getElementById("titular");
	const email = document.getElementById("email");
	const tarjeta = document.getElementById("tarjeta");
	const vencimiento = document.getElementById("vencimiento");
	const cvv = document.getElementById("cvv");
	const direccion = document.getElementById("direccion");

	fetch('api/registro.php',{
		method: "POST",
		headers: {"content-type": "application/json"},
		body: JSON.stringify({
			'titular': titular.value,
			'email': email.value,
			'contraseña': password.value,
			'numero_tarjeta': tarjeta.value,
			'fecha_vencimiento': vencimiento.value,
			'cvv': cvv.value,
			'direccion': direccion.value,
		})
	}).then((res) => 
	{	
		if (res.ok){
			window.location.href = "index.php";
		}
		else{
			res.json().then((json) => console.log(json))
		}

	});
  
	// Acá llamamos a la API (simulado con alert)
	// Redirigir al login después del registro
}