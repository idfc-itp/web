import { mostrarLibros  } from "./funciones.js";
window.onload = ()=>{
    consultarLibros();
}

async function consultarLibros(){
    try {
        const url = '../libros.php';
        const resultado = await fetch(url);
        const libros = await resultado.json();
        listarLibros(libros);   
    } catch (error) {
        console.log(error);
    }
}
function listarLibros(libros){
    const tabla = document.querySelector('.libros__body');
    libros.forEach(libro => {
        // Extraccción de valores de cada libro
        const {idLibro, titulo, autor, rutaLibro} = libro;
        
        // Creción del tr
        const fila = document.createElement('tr');

        // Creación de los td de cada row
        const celdaId = document.createElement('td');
        const celdaTitulo = document.createElement('td');
        const celdaAutor = document.createElement('td');
        const celdaRuta = document.createElement('td');

        // Asignación de valores
        celdaId.textContent = idLibro;
        celdaTitulo.textContent = titulo;
        celdaAutor.textContent = autor;
        celdaRuta.textContent = rutaLibro;

        // AppendChilds
        fila.appendChild(celdaId);
        fila.appendChild(celdaTitulo);
        fila.appendChild(celdaAutor);
        fila.appendChild(celdaRuta);
        tabla.appendChild(fila);
    });

}