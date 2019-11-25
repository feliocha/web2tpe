"use strict"

let articulo = document.getElementById("divcomentarios").dataset.id;
let usuario = document.getElementById("divcomentarios").dataset.user;

let app = new Vue({
    el: "#template-vue-comentarios",
    data: {
        adm= false,
        comentarios: [], 
        auth: true
    },
    methods: {
        borrarComentario: deleteComentario
      }
});

function getcomentarios() {
if (user.admin) {
app.adm= true;
    
} 

fetch("http://localhost/proyectos/mfindumentaria/api/comentarios/" + articulo)
    .then(response => response.json())
    .then(comentarios=> {
        
        if (comentarios != null) {
            app.comentarios= comentarios;
        }
    })
    .catch(error => console.log(error));
}

document.querySelector("#form-comentario").addEventListener('submit', addcomentario);

async function deleteComentario(id) {


    //traer un comentario y chekear 
    try{   
        let r= await fetch("http://localhost/proyectos/mfindumentaria/api/comentarios/" + id,  {'method': 'DELETE'});
        let r2= await r.json();
        getcomentarios();
    }
    catch(error){
        console.log(error);
    }
   
}


function addcomentario(e) {
    e.preventDefault();
    getpromedio();
    
    let data = {
        id_articulo: articulo,
        usuario: usuario,
        texto:  document.querySelector("input[name=texto]").value,
        calificacion:  document.querySelector("input[name=calificacion]").value
    }

    fetch('api/comentarios', {
        method: 'POST',
        headers: {'Content-Type': 'application/json'},       
        body: JSON.stringify(data) 
     })
     .then(response => {
         getcomentarios();
         getpromedio();
         //vacia los inputs
         document.querySelector("input[name=texto]").value = '';
         document.querySelector("input[name=calificacion]").value = '';
     })
     .catch(error => console.log(error));
     getpromedio();
}

function getpromedio() {
    fetch("http://localhost/proyectos/mfindumentaria/api/comentarios/promedio/" + articulo)
    .then(response => response.json())
    .then(promedio=> {
               
        let promediodiv = document.querySelector("#caca");
        promediodiv.innerHTML = "";
        promediodiv.innerHTML += ` <li> El promedio de calificacion del articulo es: ${Object.values(promedio)} </li>`; //dice object object, busque en internet y aparecio "(Object.values(promedio))" (preguntar al profe para cambiar los endpoint)
        
    })
    .catch(error => console.log(error));
}



getpromedio();
getcomentarios();