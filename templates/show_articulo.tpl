{include file="header.tpl"}


        <h1>articulo:{$articulo->nombre}</h1>

        
        <li>Precio: ${$articulo->precio}</li>

        <form action="modificararticulo/{$articulo->id_articulo}" method="post">
            Si quiere modificar este articulo: 
            nombre:<input type="text" name="nombremodificado" placeholder="Nombre" value="{$articulo->nombre}">
            precio:<input type="number" name="preciomodificado" max="30000" value="{$articulo->precio}">
            <input type="submit" value="Modificar Articulo">
        </form>

                            
                        <div id=divcomentarios data-id={$articulo->id_articulo}>  
                        
                            <ul id="comentarios">

                            </ul>

                        <form id="form-comentario" action="insertar" method="post">
                            <input type="text" name="texto" placeholder="escriba aqui">
                            <input type="number" name="calificacion"  max="10">
                            <input type="submit" value="Insertar">
                        </form>
                    
                    </div>


        agregar img 
        

       <script src="js/comentarios.js"></script> 
{include file="footer.tpl"}
