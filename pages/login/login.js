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

window.location.href= "carrito.html"

});