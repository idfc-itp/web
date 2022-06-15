//Imports
import { mostrarAlerta  } from "./funciones.js";
import { mostrarLibros  } from "./funciones.js";
//Selectores
const footerFecha = document.querySelector('.footer__span');
let year = new Date;
footerFecha.textContent = year.getFullYear();
//Event Listeners
window.onload = ()=>{
    consultarLibros();
}

async function consultarLibros(){
    try {
        const url = 'http://localhost:5000/libros.php';
        const resultado = await fetch(url);
        const libros = await resultado.json();
        console.log(libros);
        mostrarLibros(libros);   
    } catch (error) {
        console.log(error);
    }
}
