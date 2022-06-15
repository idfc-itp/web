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
        const celdaAcciones = document.createElement('td');
        const eliminar = document.createElement('input');
        const editar = document.createElement('a');
        const formularioEliminar = document.createElement('form');
        const id = document.createElement('input');
        id.type = 'hidden';
        id.value = idLibro;
        id.name = "id";

        formularioEliminar.method = 'POST';

        eliminar.type = "submit";
        eliminar.value="Eliminar"
        formularioEliminar.appendChild(id);
        formularioEliminar.appendChild(eliminar);

        eliminar.classList.add('libros__borrar', 'alert', 'enlace');
        editar.classList.add('libros__editar', 'alert', 'enlace');
        editar.href = `./libros/actualizar.php?id=${idLibro}`;

        eliminar.dataset.libro = idLibro;
        editar.dataset.libro = idLibro;

        // Asignación de valores
        celdaId.textContent = idLibro;
        celdaTitulo.textContent = titulo;
        celdaAutor.textContent = autor;
        celdaRuta.textContent = rutaLibro;
        eliminar.textContent = "Eliminar";
        editar.textContent = "Editar";

        // AppendChilds
        fila.appendChild(celdaId);
        fila.appendChild(celdaTitulo);
        fila.appendChild(celdaAutor);
        fila.appendChild(celdaRuta);
        celdaAcciones.appendChild(formularioEliminar);
        celdaAcciones.appendChild(editar);
        fila.appendChild(celdaAcciones);
        tabla.appendChild(fila);
    });

}