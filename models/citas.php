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
        $query =$db->prepare( "SELECT
                    id, author
                FROM
                    posts
                ORDER BY
                    author");

        
        $query->execute();

        return $query;
    }
    
    function insertar(){
        echo 'insertado';
    }

}

?>