<p><strong>Listado de las citas:</strong></p>
<?php foreach ($citas as $citas) { ?>
    <p>
        <?php echo $citas->cita; ?>
        <a href='?controller=citas&action=show&id=<?php echo $citas->id; ?>'>Ver
            contenido</a>
           </p>
<?php } ?>