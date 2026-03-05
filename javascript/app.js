// Atrapamos los elementos usando su selector (como en CSS) 
const titulo = document.querySelector('#titulo-principal'); 
const parrafo = document.querySelector('.mensaje'); 
const bateriaElemento = document.getElementById('bateria');
// Comprobamos en la consola oculta (F12) que los atrapamos bien 
console.log(titulo);

// Modificamos el DOM directamente 
titulo.textContent = "¡Conexión Establecida, Ingeniero!";
titulo.style.color = "#ff0084";
titulo.style.backgroundColor = "#000000";
bateriaElemento.textContent = 'Batería: 100% Cargada';
bateriaElemento.style.color = 'green';
// Usamos let porque el usuario puede cambiar en el futuro 
let nombreUsuario = "Administrador";
parrafo.textContent = "Bienvenido al sistema central, " + nombreUsuario;