// Función que muestra el listado de usuarios registrados
async function consultarUsuarios(){
    try{
        const url = 'http://localhost:5000/usuarios.php';
        const resultado = await fetch(url);
        const usuarios = await resultado.json();
        mostrarUsuarios(usuarios);   
    }catch(error){
        console.log(error);
    }
}

function mostrarUsuarios(usuarios){
    const divUsuarios = document.querySelector('.usuarios');
    usuarios.forEach(usuario => {
        const {nombre, apellido, nombreUsuario, tipoUsuario, idUsuario} = usuario;
        const divContenido = document.createElement('div');
        const nombreP = document.createElement('p');
        const apellidoP = document.createElement('p');
        const usuarioP = document.createElement('p');
        const tipoP = document.createElement('p');
        const idP = document.createElement('p');

        // Asignación de valores
        nombreP.textContent = nombre;
        apellidoP.textContent = apellido;
        usuarioP.textContent = nombreUsuario;
        tipoP.textContent = tipoUsuario;
        idP.textContent = idUsuario;

        // AppendChilds
        divContenido.appendChild(nombreP);
        divContenido.appendChild(apellidoP);
        divContenido.appendChild(usuarioP);
        divContenido.appendChild(tipoP);
        divContenido.appendChild(idP);

        divUsuarios.appendChild(divContenido);
    })
}