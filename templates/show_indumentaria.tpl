{include file="header.tpl"}
                                   
            {foreach from=$lista_indumentaria item=articulos}
                <li><a href='mostrararticulo/{$articulos->id_articulo}'>{$articulos->nombre}: {$articulos->precio}</a><a href='borrararticulo/{$articulos->id_articulo}'>Borrar</a></li>
            {/foreach}
            
            categorias:
            {foreach from=$lista_categorias item=categorias}
                <li><a href='mostrar/{$categorias->id_categoria}'>{$categorias->nombre}: {$categorias->cantidad}</a><a href='borrarcategoria/{$categorias->id_categoria}'>Borrar</a></li>
            {/foreach}
            Usuarios
            {foreach from=$lista_users item=user}
                <li>{$user->email} Condicion de administrador: 
                
                    {if $user->admin eq 0}
                    No es administrador.<a href='borrar/{$user->userId}'>borrar</a>
                    .<a href='permiso/{$user->userId}'>dar permiso</a>
                    {else}
                    Es administrador. 
                    <a href='borrar/{$user->userId}'>borrar</a>
                    .<a href='permiso/{$user->userId}'>quitar permiso</a>
                        
                {/if}</li>
            {/foreach}
            
        <form action="insertar" method="post">
            Inserte articulos: 
            <input type="text" name="nombre" placeholder="Nombre">
            <input type="number" name="precio" placeholder= "Precio" max="30000">
            <select name="categoria">
                {foreach from=$lista_categorias item=categorias}
                    <option value="{$categorias->id_categoria}">{$categorias->nombre}</option>
                {/foreach}
            </select>
            <input type="submit" value="Insertar">
        </form>

        <form action="insertar" method="post">
            Inserte categorias: 
            <input type="text" name="nombre" placeholder="Nombre">
            <input type="number" name="cantidad" placeholder="Cantidad"  max="30000">
            <input type="submit" value="Insertar">
        </form>

        <form action="logout">
            <input type="submit" value="Cerrar Sesion">       
        </form>
        
    </body>
</html>