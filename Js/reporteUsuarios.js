window.onload = ()=>{
    consultarUsuarios();
}
async function consultarUsuarios(){
    const url = '../../usuarios.php';
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

        // Asignación de valores
        celdaId.textContent = idUsuario;
        celdaNombre.textContent = nombre;
        celdaApellido.textContent = apellido;
        celdaUsuario.textContent = nombreUsuario;

        // AppendChilds
        fila.appendChild(celdaId);
        fila.appendChild(celdaNombre);
        fila.appendChild(celdaApellido);
        fila.appendChild(celdaUsuario);
        tabla.appendChild(fila);
    });

}