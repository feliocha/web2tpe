{include file="header.tpl"}
    <h1> BIENVENIDO A MF INDUMENTARIA </h1>
    <h2> Articulos: </h2>
    <table class="table">
        <thead>
            <tr>
                <th scope="col">Producto</th>
                <th scope="col">Precio</th>
            </tr>
        </thead>
        <tbody>
            {foreach from=$lista_indumentaria item=articulos}
                <tr>
                    <td><a href='mostrararticuloinvitado/{$articulos->id_articulo}'>{$articulos->nombre}</a></td>
                    <td>${$articulos->precio}</td>
                </tr>
            {/foreach}
        </tbody>
    </table>
    <h2> Categorias: </h2>
    {foreach from=$lista_categorias item=categorias}
        <li><a href='mostrarcategoriainvitado/{$categorias->id_categoria}'>{$categorias->nombre}: {$categorias->cantidad}</a></li>
    {/foreach}

{include file="footer.tpl"}
