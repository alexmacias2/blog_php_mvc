<a href='?controller=posts&action=frmUpdate&id=<?php echo $post->id; ?>'>Update</a>
<p><strong>Post #<?php echo $post->id; ?></strong></p>
<p><strong>Autor: </strong><?php echo $post->author; ?></p>
<p><strong>Post: </strong><?php echo $post->content; ?></p>
<p>   <img src="data:image/png;base64,<?php echo base64_encode($post->imagen); ?>" alt="No hay foto" />
</p>
<p><strong>Título: </strong><?php echo $post->titulo; ?></p>
<p><strong>Creado: </strong><?php echo $post->creado; ?></p>
<p><strong>Modificado: </strong><?php echo $post->modificado; ?></p>


