{include file="header.tpl"}
        <div class="sidenav">
            <div class="login-main-text">
                <h2>MFindumentaria <br>Acceso a la administracion</h2>
                <p>Inicie sesion o registrese para ser administrador</p>
            </div>
        </div>        
        <div class="main">
            <div class="col-md-6 col-sm-12">
                <form class="form-group" action="iniciarSesion" method="post">
                    Usuario
                    <input class="form-control" type="text" name="user" placeholder="Usuario">
                    Contraseña
                    <input class="form-control" type="password" name="pass" placeholder="Password">
                    <button type="submit" class="btn btn-dark">Login</button>
                </form>
                <form class="form-group" action="entrarcomoinvitado">
                    <button type="submit" class="btn btn-dark">Entrar como invitado</button>
                </form>
                <form class="form-group" action="registrarse">
                    <button type="submit" class="btn btn-dark">Registrarse</button>
                </form>
            </div>
        </div>

    </body>
</html>