//Función que crea una alerta con un mensaje de error
export function mostrarAlerta(mensaje, position, type){
    const alertas = document.querySelectorAll('.error');
    const success = document.querySelectorAll('.success');
    if(alertas.length === 0 && success.length === 0){
        const alerta = document.createElement('p');
        alerta.textContent = mensaje;
        alerta.classList.add('alert');
        if(type==="error"){
            alerta.classList.add('error');
            alerta.classList.remove('success');
        }else{
            alerta.classList.add('success');
            alerta.classList.remove('error');
        }
        position.appendChild(alerta);
        setTimeout(() => {
            alerta.remove();
        }, 3000);
    }
}
// Función que muestra los libros consultados en el grid de libros__grid
export function mostrarLibros(libros){
    const librosGrid = document.querySelector('.libros__grid');
    libros.forEach(libro => {
        // Extracción de datos del objeto libro
        const {idLibro, titulo, autor, rutaLibro} = libro;

        // Creación de los elementos del card
        const divLibro = document.createElement('div');
        const libroHeading = document.createElement('div');
        const libroBody = document.createElement('div');
        const libroTitulo = document.createElement('h3');
        const libroAutor = document.createElement('span');
        const verLibro = document.createElement('a');
        const saberMas = document.createElement('a');
        const descargar = document.createElement('a');


        saberMas.href = `libro.php?id=${idLibro}`;
        // Sección para agregar el texto a cada elemento del card
        libroTitulo.textContent = titulo;
        libroAutor.innerHTML = `Autor: <span class="libro__span">${autor}<span>`;
        verLibro.href = rutaLibro;
        verLibro.textContent = "Ver libro";
        verLibro.target = "_blank"; 
        divLibro.dataset.id = idLibro;
        saberMas.textContent = "Saber más";
        descargar.textContent = "Descargar";
        // descargar.download = titulo;
        descargar.onclick = ()=>{
            contarDescarga(libro);
        }
        // descargar.href = rutaLibro;

        // Agregar clases
        divLibro.classList.add('libro');
        libroHeading.classList.add('libro__header');
        libroBody.classList.add('libro__contenido');
        libroTitulo.classList.add('libro__titulo');
        libroAutor.classList.add('libro__autor');
        verLibro.classList.add('libro__link');
        saberMas.classList.add('libro__link');
        descargar.classList.add('libro__link');
        
        // AppendChilds 
        libroHeading.appendChild(libroTitulo);
        libroHeading.appendChild(libroAutor);
        libroBody.appendChild(verLibro);
        libroBody.appendChild(saberMas);
        libroBody.appendChild(descargar);
        divLibro.appendChild(libroHeading);
        divLibro.appendChild(libroBody);
        librosGrid.appendChild(divLibro);
    });
}
// Función que permitirá contar las descargas de cada libro, pero todavía no funciona
function contarDescarga(libro){
    const {idLibro, titulo} = libro;
}
