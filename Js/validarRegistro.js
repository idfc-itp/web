import { mostrarAlerta } from "./funciones.js";

const registerForm = document.querySelector('.formulario__registro');

//Event Listeners
window.onload = ()=>{
    registerForm.addEventListener('submit', validarRegistro);
}
// Función que valida los campos del formulario de registro
function validarRegistro(e){
    e.preventDefault();
    const nombreInput = document.querySelector('.input-nombre');
    const apellidoInput = document.querySelector('.input-apellido');
    const usuarioInput = document.querySelector('.input-usuario');
    const passwordInput = document.querySelector('.input-password');
    if(nombreInput.value === '' || apellidoInput.value === '' || usuarioInput.value === '' || passwordInput.value === ''){
        mostrarAlerta('Todos los campos son obligatorios', document.querySelector('.registro__alerta'), 'error');
        return;
    }
    mostrarAlerta('Usuario creado correctamente', document.querySelector('.registro__alerta'), 'success');
    setTimeout(() => {
        location.href = '../index.php';
    }, 3000);
    console.log('Se pasó la validación');
}
