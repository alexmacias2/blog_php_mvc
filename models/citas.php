<?php

class Cita {

    // definimos tres atributos
    // los declaramos como públicos para acceder directamente $post->author
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

        // creamos una lista de objectos post y recorremos la respuesta de la
        //consulta
        foreach ($req->fetchAll() as $citas) {
            $list[] = new Cita($citas['id'], $citas['cita'], $citas['post_id'], $citas['creado'], $citas['oficializado']);
        }
        return $list;
    }

    public static function find($id) {
        $db = Db::getInstance();
        // nos aseguramos que $id es un entero
        $id = intval($id);
        $req = $db->prepare('SELECT * FROM citas WHERE id = :id');
        // preparamos la sentencia y reemplazamos :id con el valor de $id
        $req->execute(array('id' => $id));
        $citas = $req->fetch();
        return new Cita($citas['id'], $citas['cita'], $citas['post_id'], $citas['creado'], $citas['oficializado']);
    }

    function readPost() {
        $db = Db::getInstance();
        //select all data
        $query = $db->prepare("SELECT
                    id, author
                FROM
                    posts
                ORDER BY
                    author");


        $query->execute();

        return $query;
    }

    function insertar() {
        $cita = $_POST['cita'];
        $post_id = $_POST['post_id'];
        $creado = $_POST['creado'];
        $oficializado = $_POST['oficializado'];
        $db = Db::getInstance();
        $query = $db->prepare("INSERT INTO citas
            SET cita=:cita, post_id=:post_id, creado=:creado,
                oficializado=:oficializado");

        $cita = htmlspecialchars(strip_tags($cita));
        $post_id = htmlspecialchars(strip_tags($post_id));
        $creado = htmlspecialchars(strip_tags($creado));
        $oficializado = htmlspecialchars(strip_tags($oficializado));

        $query->bindParam(':cita', $cita);
        $query->bindParam(':post_id', $post_id);
        $query->bindParam(':creado', $creado);
        $query->bindParam(':oficializado', $oficializado);

        $query->execute();
    }

    function update() {
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
        $id = htmlspecialchars(strip_tags($id));
        $cita = htmlspecialchars(strip_tags($cita));
        $post_id = htmlspecialchars(strip_tags($post_id));
        $creado = htmlspecialchars(strip_tags($creado));
        $oficializado = htmlspecialchars(strip_tags($oficializado));

        $query->bindParam(':id', $id);
        $query->bindParam(':cita', $cita);
        $query->bindParam(':post_id', $post_id);
        $query->bindParam(':creado', $creado);
        $query->bindParam(':oficializado', $oficializado);

        $query->execute();
    }

    public function delete() {
        $citas = Cita::find($_GET['id']);
        $db = Db::getInstance();
        $query = $db->prepare("DELETE FROM citas WHERE id = ?");
        $query->bindParam(1, $citas->id);
        $query->execute();
    }

}

?>