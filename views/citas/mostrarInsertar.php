<form action='?controller=citas&action=insertar' method="post" enctype="multipart/form-data">
    <p>
        <label>Cita: </label>
        <input type="text" id="cita" name="cita" required="required"/><br/>
        <label>Post_id:</label><br/>
        <?php
                // leemos los post id de la base de datos
                $stmt = Cita::readPost();
                //los metemos en el select
                echo "<select class='form-control' name='post_id'>";

                while ($row_category = $stmt->fetch(PDO::FETCH_ASSOC)) {
                    extract($row_category);
                    echo "<option value='{$id}'>{$author}</option>";
                }

                echo "</select>";
                ?><br/>
        <label>Creado:</label><br/>
        <input type="date" id="creado" name="creado" required="required"/><br/>
        <label>Oficializado:</label><br/>
        <select class="form-control" name="oficializado">
            <option>Selecciona:</option>
            <option>Si</option>
            <option>No</option>
        </select>
        <input type="submit" value="Insertar" name='submit'/>
    </p>
</form>
