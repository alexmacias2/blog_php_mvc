<?php

class Cita {//Clase modelo de la tabla citas

    //definimos los atributos del modelo y los hacemos publicos para poder acceder
    public $id;
    public $cita;
    public $post_id;
    public $creado;
    public $oficializado;

    public function __construct($id, $cita, $post_id, $creado, $oficializado) {
        $this->id = $id;
        $this->cita = $cita;
        $this->post_id = $post_id;
        $this->creado = $creado;
        $this->oficializado = $oficializado;
    }

    public static function all() {
        $list = [];
        $db = Db::getInstance(); //devuelve la conexion a la base de datos
        $req = $db->query('SELECT * FROM citas');

        //guardamos todos los datos de la tabla citas mediante el foreach
        foreach ($req->fetchAll() as $citas) {
            $list[] = new Cita($citas['id'], $citas['cita'], $citas['post_id'], $citas['creado'], $citas['oficializado']);
        }
        return $list;//retornamos la lista de citas
    }

    public static function find($id) {//método que nos devuelve una cita mediante el id
        $db = Db::getInstance();
        $id = intval($id);//el id debe ser un int
        $req = $db->prepare('SELECT * FROM citas WHERE id = :id');//preparamos la sentencia
        $req->execute(array('id' => $id));//ejecutamos la sentencia remplaxando los valores
        $citas = $req->fetch();//guardamos en la variable los datos de esta cita
        return new Cita($citas['id'], $citas['cita'], $citas['post_id'], $citas['creado'], $citas['oficializado']);//finalmente retornamos los valores
    }

    function readPost() {//método para obtener los posibles posts que hay y que necesitaremos para el formulario de insertar y update
        $db = Db::getInstance();
        //sentencia que recogerá todos los posts guardando solo su id y author además los ordenará por autor
        $query = $db->prepare("SELECT 
                    id, author
                FROM
                    posts
                ORDER BY
                    author");


        $query->execute();//ejecutamos

        return $query;//retornamos la sentencia
    }

    function insertar() {//método que insertará en la base de datos
        //primero guardamos todas las variables
        $cita = $_POST['cita'];
        $post_id = $_POST['post_id'];
        $creado = $_POST['creado'];
        $oficializado = $_POST['oficializado'];
        $db = Db::getInstance();
        $query = $db->prepare("INSERT INTO citas
            SET cita=:cita, post_id=:post_id, creado=:creado,
                oficializado=:oficializado");
        //eliminamos la posibilidad de introducir etiquetas
        $cita = htmlspecialchars(strip_tags($cita));
        $post_id = htmlspecialchars(strip_tags($post_id));
        $creado = htmlspecialchars(strip_tags($creado));
        $oficializado = htmlspecialchars(strip_tags($oficializado));
        
        //seteamos los valores en la consulta
        $query->bindParam(':cita', $cita);
        $query->bindParam(':post_id', $post_id);
        $query->bindParam(':creado', $creado);
        $query->bindParam(':oficializado', $oficializado);

        $query->execute();//ejecutamos
    }

    function update() {//método que hara el update
        // guardamos el id y las demás variables
        $citas = Cita::find($_GET['id']);
        $id = $citas->id;
        $cita = $_POST['cita'];
        $post_id = $_POST['post_id'];
        $creado = $_POST['creado'];
        $oficializado = $_POST['oficializado'];
        $db = Db::getInstance();
        $query = $db->prepare("UPDATE
                citas
            SET
                cita = :cita,
                post_id = :post_id,
                creado = :creado,
                oficializado  = :oficializado
            WHERE
                id = :id");
        //como antes eliminamos etiquetas
        $id = htmlspecialchars(strip_tags($id));
        $cita = htmlspecialchars(strip_tags($cita));
        $post_id = htmlspecialchars(strip_tags($post_id));
        $creado = htmlspecialchars(strip_tags($creado));
        $oficializado = htmlspecialchars(strip_tags($oficializado));
        //seteamos los valores en la sentencia preparada
        $query->bindParam(':id', $id);
        $query->bindParam(':cita', $cita);
        $query->bindParam(':post_id', $post_id);
        $query->bindParam(':creado', $creado);
        $query->bindParam(':oficializado', $oficializado);

        $query->execute();//ejecutamos
    }

    public function delete() {//método que hará el delete
        $citas = Cita::find($_GET['id']);//guardamos los datos de la cita a eliminar
        $db = Db::getInstance();
        $query = $db->prepare("DELETE FROM citas WHERE id = ?");
        $query->bindParam(1, $citas->id);//seteamos en la sentencia el valor del id
        $query->execute();//ejecutamos
    }

}

?>