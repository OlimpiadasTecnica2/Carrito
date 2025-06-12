document.getElementById("formulario").onsubmit = function(event) {
	event.preventDefault();
  
	let password = document.getElementById("password");
	let confirmPassword = document.getElementById("confirmPassword").value;
  
	if (password.value !== confirmPassword) {
	  alert("Las contraseñas no coinciden.");
	  return;
	}

	const email = document.getElementById("email");

	fetch('api/registro.php',{
		method: "POST",
		headers: {"content-type": "application/json"},
		body: JSON.stringify({
			'nombre_usuario': document.getElementById("nombre_usuario").value,
			'email': email.value,
			'contraseña': password.value,
		})
	}).then((res) => 
	{	
		if (res.ok){
			window.location.href = "index.php";
		}
		else{
			res.json().then((json) => alert(json.mensaje));
		}

	});
  
	return false;
}