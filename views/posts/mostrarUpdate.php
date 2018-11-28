
<form action='?controller=posts&action=update&id=<?php echo $post->id; ?>' method="post" enctype="multipart/form-data">
    <p>
<!--        <input type="file" value="<?php echo $post->titulo; ?>" style="visibility: hidden" id="fotooculta" name="fotooculta"/>-->
        <label>Author: </label><br/>
        <input type="text" id="author" name="author" required="required" value=" <?php echo $post->author; ?>"/><br/>
        <label>Content:</label><br/>
        <input type="text" id="post" name="post" required="required" value="<?php echo $post->content;?>"/><br/>
        <label>Titulo:</label><br/>
        <input type="text" id="titulo" name="titulo" required="required" value="<?php echo $post->titulo;?>"/><br/>
        <label>Imagen:</label><br/>
        <input type="file" id="imagen" name="imagen" ><br/>
        <img src="data:image/png;base64,<?php echo base64_encode($post->imagen); ?>" alt="No hay foto"/><br/>
        <label>Creado:</label><br/>
        <input type="date" id="creado" name="creado" required="required" value="<?php echo $post->creado;?>" readonly="readonly"/><br/>
        <label>Modificado:</label><br/>
        <input type="text" id="modificado" name="modificado" required="required" value="La fecha se actualizará." readonly="readonly" /><br/>
        <input type="submit" value="Modificar" name='submit'/>
    </p>
</form>
