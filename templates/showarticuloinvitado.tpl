{include file="header.tpl"}
    
                    <h1>bienvenido {$nombreusuario}</h1>
                    
                    <h2>{$articulo->nombre}</h2>

                    <li>Precio: ${$articulo->precio}</li>

                    {if {$user} eq 0}
                    podes agregar comentarios (sos usuario normal)
                    {/if}

                    {if {$user} eq 3}
                    sos invitado no podes agregar nada                      
                    {/if}
                    
                    <div id=divcomentarios data-user={$nombreusuario} data-id={$articulo->id_articulo}>  
                        
                        <!-- <ul id="comentarios">-->

                        <!-- </ul>-->
                        {include file="./vue/comentarios_vue.tpl"}
                        <form id="form-comentario" action="insertar" method="post">
                            <input type="text" name="texto" placeholder="escriba aqui">
                            <input type="number" name="calificacion"  max="10">
                            <input type="submit" value="Insertar">
                        </form>
                    
                    </div>

                    <div id=promedio>
                        <ul id=caca>
                          
                        </ul>
                    </div>
                                      
                    <form action="logout">
                        <input type="submit" value="Cerrar Sesion">       
                    </form>
                    
                    
                    <script src="js/comentarios.js"></script>

{include file="footer.tpl"}