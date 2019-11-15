{include file="header.tpl"}
        <form action="completarregistro" method="post">
            <input type="text" name="user" placeholder="Usuario">
            <input type="password" name="pass" placeholder="Password">
            <select name="admin">
            <option value="0">Registrarse como usuario normal</option>
            <option value="1">Registrarse como administrador</option>
            </select>
            <input type="submit" value="Completar Registro">
        </form>
{include file="footer.tpl"}