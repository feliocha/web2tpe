{include file="header.tpl"}
    
                    <h1>{$articulo->nombre}</h1>

                    <li>Precio: ${$articulo->precio}</li>

                    {if {$user} eq 0}
                    aca van los comentarios (sos usuario normal)
                    {/if}

                    {if {$user} eq 3}
                    jeje sos invitado                       
                    {/if}
                    
                    <form action="logout">
                        <input type="submit" value="Cerrar Sesion">       
                    </form>

{include file="footer.tpl"}