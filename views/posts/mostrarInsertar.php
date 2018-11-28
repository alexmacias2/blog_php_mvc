<form action='?controller=posts&action=insertar' method="post" enctype="multipart/form-data">
    <p>
        <label>Author: </label>
        <input type="text" id="author" name="author" required="required"/><br/>
        <label>Content:</label><br/>
        <input type="text" id="post" name="post" required="required" /><br/>
        <label>Titulo:</label><br/>
        <input type="text" id="titulo" name="titulo" required="required"/><br/>
        <label>Imagen:</label><br/>
        <input type="file" id="imagen" name="imagen" required="required"/><br/>
        <label>Creado:</label><br/>
        <input type="text" id="creado" name="creado" required="required" value="La fecha se seteará."/><br/>
        <label>Modificado:</label><br/>
        <input type="text" id="modificado" name="modificado" required="required" value="La fecha se seteará."/><br/>
        <input type="submit" value="Insertar" name='submit'/>
    </p>
</form>
