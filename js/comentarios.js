"use strict"

let adm = document.getElementById("divcomentarios").dataset.adm;
let articulo = document.getElementById("divcomentarios").dataset.id;
let usuario = document.getElementById("divcomentarios").dataset.user;

let app = new Vue({
    el: "#template-vue-comentarios",
    data: {
        promedio: 0,
        adm: false,
        comentarios: []
    },
    methods: {
        borrarComentario: deleteComentario
      }
});


function getcomentarios() {
    if (adm == 1) {
      app.adm= true;  
    } 
    fetch("api/comentarios/" + articulo)
    .then(response => response.json())
    .then(comentarios=> {
        
        if (comentarios != null) {
            app.comentarios= comentarios;
            getpromedio();

        }
    getimagenes();
    })
    .catch(error => console.log(error));
}
console.log(adm);
if (adm != 1) {
      document.querySelector("#form-comentario").addEventListener('submit', addcomentario);
}

async function deleteComentario(id) {
    
    try{   
        let r= await fetch("api/comentarios/" + id,  {'method': 'DELETE'});
        let r2= await r.json();
        getcomentarios();

    }
    catch(error){
        console.log(error);
    }
   
}



function addcomentario(e) {
    e.preventDefault();
    let texto = document.querySelector("input[name=texto]").value;
    let calificacion = document.querySelector("input[name=calificacion]").value
    
    if (!(texto == "") && !(calificacion=="")){
    let data = {
        id_articulo: articulo,
        usuario: usuario,
        texto:  texto,
        calificacion:  calificacion
    }
    

    fetch('api/comentarios', {
        method: 'POST',
        headers: {'Content-Type': 'application/json'},       
        body: JSON.stringify(data) 
     })
     .then(response => {
         getcomentarios();

         //vacia los inputs
         document.querySelector("input[name=texto]").value = '';
         document.querySelector("input[name=calificacion]").value = '';
     })
     .catch(error => console.log(error));
    }else {
        alert("faltando datos");
    }

}

function getpromedio() {
    fetch("api/comentarios/promedio/" + articulo)
    .then(response => response.json())
    .then(promedio=> {
        app.promedio= promedio;
    })
    .catch(error => console.log(error));
}


getpromedio();
getcomentarios();
getimagenes();