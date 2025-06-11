const items = document.querySelectorAll('.item');
const subtotalEl = document.getElementById('subtotal');
const totalEl = document.getElementById('total');

items.forEach(item => {
  const menos = item.querySelector('.menos');
  const mas = item.querySelector('.mas');
  const cantidadEl = item.querySelector('.cantidad');
  const precio = parseFloat(item.dataset.precio);

  menos.addEventListener('click', () => {
    let cantidad = parseInt(cantidadEl.textContent);
    if (cantidad > 0) {
      cantidad--;
      cantidadEl.textContent = cantidad;
      actualizarTotales();
    }
  });

  mas.addEventListener('click', () => {
    let cantidad = parseInt(cantidadEl.textContent);
    cantidad++;
    cantidadEl.textContent = cantidad;
    actualizarTotales();
  });
});

function actualizarTotales() {
  let subtotal = 0;

  items.forEach(item => {
    const cantidad = parseInt(item.querySelector('.cantidad').textContent);
    const precio = parseFloat(item.dataset.precio);
    subtotal += cantidad * precio;
  });

  subtotalEl.textContent = subtotal;
  totalEl.textContent = subtotal; // Podés sumar impuestos si querés
}