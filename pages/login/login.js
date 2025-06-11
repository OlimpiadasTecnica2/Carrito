document.getElementById("loginForm").addEventListener("submit", function(event){
	event.preventDefault();
	let email=
	document.getElementById("email").value;
	let password =
	document.getElementById("password").value;

	//validaciones simples

	if (!email|| !password)
 {
	alert("Por favor, complete todos los campos");
	return;
}


	fetch('api/login.php',{
		method: "POST",
		headers: {"content-type": "application/json"},
		body: JSON.stringify({
			'email': email,
			'contraseña': password,
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


});