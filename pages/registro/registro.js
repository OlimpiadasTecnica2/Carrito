document.getElementById("registroForm").addEventListener("submit", function(event) {
	event.preventDefault();
  
	let password = document.getElementById("password").value;
	let confirmPassword = document.getElementById("confirmPassword").value;
  
	if (password !== confirmPassword) {
	  alert("Las contraseñas no coinciden.");
	  return;
	}
  
	// Acá llamamos a la API (simulado con alert)
	alert("Usuario registrado exitosamente");
  
	// Redirigir al login después del registro
	window.location.href = "login.html";
  });