import { mostrarAlerta } from "./funciones.js";
const loginForm = document.querySelector('.login__form');
loginForm.addEventListener('submit', validarLogin);
//Función que valida el login
function validarLogin(e){
    e.preventDefault();
    const usuarioInput = document.querySelector('.input__usuario');
    const passwordInput = document.querySelector('.input__password');
    if(passwordInput.value === '' || usuarioInput.value === ''){
        mostrarAlerta('Todos los campos son obligatorios', document.querySelector('.login__alert'), 'error');
        return;
    }
    mostrarAlerta('Login realizado correctamente', document.querySelector('.login__alert'), 'success');
    setTimeout(() => {
        location.href = '../index.php';
    }, 3000);
    passwordInput.value = '';
    usuarioInput.value = '';
}