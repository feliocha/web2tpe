{literal}
<section id="template-vue-comentarios">

    <ul v-if="comentarios !== 'No existe'">
        <p>el promedio es: {{promedio}}</p>
       <li v-for="comentario in comentarios">

           <span> {{ comentario.usuario }} :{{ comentario.texto }} - calificacion: {{comentario.calificacion}} </span> 
        <button v-if="adm" type="button" v-on:click="borrarComentario(comentario.id_comentario)">borrar</button>
       </li> 
    </ul>

</section>
{/literal}
