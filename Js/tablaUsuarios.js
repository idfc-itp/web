window.onload = ()=>{
    consultarUsuarios();
}
async function consultarUsuarios(){
    const url = 'http://localhost:5000/usuarios.php';
    try {
        const resultado = await fetch(url);
        const usuarios = await resultado.json();
        listarUsuarios(usuarios);   
    } catch (error) {
        console.log(error);
    }
}
function listarUsuarios(usuarios){
    const tabla = document.querySelector('.usuarios__body');
    usuarios.forEach(usuario => {
        // Extraccción de valores de cada usuario
        const {idUsuario, nombre, apellido, nombreUsuario} = usuario;
        // Creción del tr
        const fila = document.createElement('tr');

        // Creación de los td de cada row
        const celdaId = document.createElement('td');
        const celdaNombre = document.createElement('td');
        const celdaApellido = document.createElement('td');
        const celdaUsuario = document.createElement('td');
        const celdaAcciones = document.createElement('td');
        const eliminar = document.createElement('input');
        const editar = document.createElement('a');
        const formularioEliminar = document.createElement('form');
        const id = document.createElement('input');
        id.type = 'hidden';
        id.value = idUsuario;
        id.name = "id";

        formularioEliminar.method = 'POST';

        eliminar.type = "submit";
        eliminar.value="Eliminar"
        formularioEliminar.appendChild(id);
        formularioEliminar.appendChild(eliminar);

        eliminar.classList.add('usuarios__borrar', 'alert', 'enlace');
        editar.classList.add('usuarios__editar', 'alert', 'enlace');
        editar.href = `./actualizarUsuario.php?id=${idUsuario}`;

        eliminar.dataset.usuario = id;
        editar.dataset.usuario = id;

        // Asignación de valores
        celdaId.textContent = idUsuario;
        celdaNombre.textContent = nombre;
        celdaApellido.textContent = apellido;
        celdaUsuario.textContent = nombreUsuario;
        eliminar.textContent = "Eliminar";
        editar.textContent = "Editar";

        // AppendChilds
        fila.appendChild(celdaId);
        fila.appendChild(celdaNombre);
        fila.appendChild(celdaApellido);
        fila.appendChild(celdaUsuario);
        celdaAcciones.appendChild(formularioEliminar);
        celdaAcciones.appendChild(editar);
        fila.appendChild(celdaAcciones);
        tabla.appendChild(fila);
    });

}