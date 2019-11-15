{include file="header.tpl"}


        <h1>articulo:{$articulo->nombre}</h1>
        
        <li>Precio: ${$articulo->precio}</li>

        <form action="modificararticulo/{$articulo->id_articulo}" method="post">
            Si quiere modificar este articulo: 
            nombre<input type="text" name="nombremodificado" placeholder="Nombre" value="{$articulo->nombre}">
            precio<input type="number" name="preciomodificado" max="30000" value="{$articulo->precio}">
            <input type="submit" value="Modificar Articulo">
        </form>

        
{include file="footer.tpl"}
