{include file="header.tpl"}


        <h1>articulo:{$articulo->nombre}</h1>

        
        <li>Precio: ${$articulo->precio}</li>

        {foreach from=$imagenes item=img}
            <img src="{$img->path}" alt="" height="15%" width="15%">
        {/foreach}


        <div id=divcomentarios data-adm={$user} data-id={$articulo->id_articulo}>  
                        

            {include file="./vue/comentarios_vue.tpl"}
                        
                    
        </div>

        

        <form action="modificararticulo/{$articulo->id_articulo}" method="post">
            Si quiere modificar este articulo: 
            nombre:<input type="text" name="nombremodificado" placeholder="Nombre" value="{$articulo->nombre}">
            precio:<input type="number" name="preciomodificado" max="30000" value="{$articulo->precio}">
            <input type="submit" value="Modificar Articulo">
        </form>
  


        agregar img 
        

       <script src="js/comentarios.js"></script> 
{include file="footer.tpl"}
