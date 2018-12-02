<form action='?controller=citas&action=insertar' method="post" enctype="multipart/form-data">
    <p>
        <label>Cita: </label>
        <input type="text" id="cita" name="cita" required="required"/><br/>
        <label>Post_id:</label><br/>
        <?php
                // read the product categories from the database
                $stmt = Cita::readPost();

                // put them in a select drop-down
                echo "<select class='form-control' name='post_id'>";
                echo "<option>Selecciona post...</option>";

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
