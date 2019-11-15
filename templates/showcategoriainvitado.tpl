{include file="header.tpl"}

        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="entrarcomoinvitado">Home</a></li>
          <li class="breadcrumb-item active">{$categoria->nombre}</li>
        </ol>
            
        <h1>Estas en la categoria {$categoria->nombre}</h1>
          
          {foreach from=$lista_indumentaria item=articulos}         
            <article class="row">
              
              <aside class="col-md-6">
                <a href="#">
                  <img class="img-fluid rounded mb-3 mb-md-0" src="Imagenes/CamperaPumaArsenal2.jpg" alt="">
                </a>
              </aside>

              <section class="col-md-5">
                <h3>{$articulos->nombre} </h3>
                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Laudantium veniam exercitationem expedita
                  laborum
                  at voluptate. Labore, voluptates totam at aut nemo deserunt rem magni pariatur quos perspiciatis atque
                  eveniet
                  unde.
                </p>
                <a class="btn btn-primary" href="mostrararticuloinvitado/{$articulos->id_articulo}">Ver Producto
                  <span class="glyphicon glyphicon-chevron-right"></span>
                </a>
              </section>
            
            </article>
          {/foreach}
              
        <form action="logout">
          <input type="submit" value="Cerrar Sesion">       
        </form>
            
{include file="footer.tpl"}