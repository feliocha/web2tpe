{include file="header.tpl"}
            <h1>Estas en la categoria {$categoria->nombre}</h1>
            
            {foreach from=$lista_indumentaria item=articulos}
                    <li>{$articulos->nombre}:${$articulos->precio}</li>
            {/foreach}

            

        <form action="insertar" method="post">
            inserte articulos
            <input type="text" name="nombre" placeholder="nombre">
            <input type="number" name="precio"  max="30000">
            <select name="categoria">
                    <option value="{$categoria->id_categoria}">{$categoria->nombre}</option>
            </select>
            <input type="submit" value="insertar">
        </form>
        
        <form action="modificarcategoria/{$categoria->id_categoria}" method="post">
            Si quiere modificar esta categoria:
            nombre<input type="text" name="categoriamodificada" placeholder="Nombre" value="{$categoria->nombre}">
            precio<input type="number" name="cantidadnueva" max="30000" value="{$categoria->cantidad}">
            <input type="submit" value="Modificar Categoria">
        </form>

    </body>
</html>