<form action='?controller=citas&action=update&id=<?php echo $citas->id; ?>' method="post" enctype="multipart/form-data">
    <p>
        
        <label>Cita: </label>
        <input type="text" id="cita" name="cita" required="required" value='<?php echo $citas->cita?>'/><br/>
        <label>Post_id:</label><br/>
        <?php
                // read the product categories from the database
                $stmt = Cita::readPost();

                // put them in a select drop-down
                echo "<select class='form-control' name='post_id' required='required'>";

                while ($row_category = $stmt->fetch(PDO::FETCH_ASSOC)) {
                    extract($row_category);
                    echo "<option value='{$id}'>{$author}</option>";
                }

                echo "</select>";
                ?><br/>
        <label>Creado:</label><br/>
        <input type="date" id="creado" name="creado" required="required" value="<?php echo $citas->creado?>" readonly="readonly"/><br/>
        <label>Oficializado:</label><br/>
        <select class="form-control" name="oficializado">
            <option><?php echo "$citas->oficializado"?></option>
            <option>Si</option>
            <option>No</option>
        </select>
        <input type="submit" value="Update" name='submit'/>
    </p>
</form>