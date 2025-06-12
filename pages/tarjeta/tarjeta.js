function post_compra(){
    event.preventDefault();
 
    const metodo = document.getElementById('metodo');


    const consumidor_final = document.getElementById('consumidor_final');



    return false;
}

function change_metodo(){
    const metodo = document.getElementById('metodo');
    if (metodo.value == "debito" || metodo.value == "credito"){
        var titular = document.createElement('input');
        var numero_tarjeta = document.createElement('input');
        var fecha_vencimiento = document.createElement('input');
        var cvv = document.createElement('input');
        var direccion = document.createElement('input');

        titular.name = "titular";
        numero_tarjeta.name = "numero_tarjeta";
        fecha_vencimiento.name = "fecha_vencimiento";
        cvv.name = "cvv";
        direccion.name = "direccion";
        

        const metodo_cont = document.getElementById('metodo_cont');
        metodo_cont.replaceChildren();
        
        var label = document.createElement('label');
        label.innerHTML = "Titular";
        label.for = "titular";
        metodo_cont.appendChild(label);
        metodo_cont.appendChild(titular);

        var label = document.createElement('label');
        label.innerHTML = "Numero de tarjeta";
        label.for = "numero_tarjeta";
        metodo_cont.appendChild(label);
        metodo_cont.appendChild(numero_tarjeta);

        var label = document.createElement('label');
        label.innerHTML = "Fecha de vencimiento";
        label.for = "fecha_vencimiento";
        metodo_cont.appendChild(label);
        metodo_cont.appendChild(fecha_vencimiento);

        var label = document.createElement('label');
        label.innerHTML = "Codigo de seguridad";
        label.for = "cvv";
        metodo_cont.appendChild(label);
        metodo_cont.appendChild(cvv);

        var label = document.createElement('label');
        label.innerHTML = "Direccion";
        label.for = "direccion";
        metodo_cont.appendChild(label);
        metodo_cont.appendChild(direccion);

    }
    else if(metodo.value == "transferencia"){
        
        const metodo_cont = document.getElementById('metodo_cont');
        metodo_cont.replaceChildren();
        var btn = document.createElement('input');
        btn.type = "checkbox";
        btn.name = "transferido";

        metodo_cont.appendChild(btn);

    }
}

    var checked = false;
    document.getElementById('consumidor_final').onchange = function(){
    const consumidor_cont = document.getElementById('consumidor_cont');
    consumidor_cont.replaceChildren();
    console.log("AMONGAS",checked);
    checked = !checked;
    if (checked){
        var nombre = document.createElement('input');
        var apellido = document.createElement('input');
        var dni = document.createElement('input');
        dni.type = "number";

        nombre.name = "nombre";
        apellido.name = "apellido";
        dni.name = "dni";

        consumidor_cont.replaceChildren();
        
        var label = document.createElement('label');
        label.innerHTML = "Nombre";
        label.for = "nombre";
        consumidor_cont.appendChild(label);
        consumidor_cont.appendChild(nombre);

        var label = document.createElement('label');
        label.innerHTML = "Apellido";
        label.for = "apellido";
        consumidor_cont.appendChild(label);
        consumidor_cont.appendChild(apellido);

        var label = document.createElement('label');
        label.innerHTML = "DNI";
        label.for = "dni";
        consumidor_cont.appendChild(label);
        consumidor_cont.appendChild(dni);
        return false;
    }else{
        consumidor_cont.replaceChildren();
        return true;
        
    }
}