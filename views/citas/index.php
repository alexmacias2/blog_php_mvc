<!--recorremos todas las citas y las mostramos-->
<p><strong>Listado de las citas:</strong></p>
<?php foreach ($citas as $citas) { ?>
    <p>
        <?php echo $citas->cita; ?>
        <a href='?controller=citas&action=show&id=<?php echo $citas->id; ?>'>Ver
            contenido</a>
<!--        boton para ver el contenido de una cita-->
        <a href='?controller=citas&action=delete&id=<?php echo $citas->id; ?>'>Borrar
            post</a>
<!--        boton para borrar una cita-->
           </p>
<?php } ?>