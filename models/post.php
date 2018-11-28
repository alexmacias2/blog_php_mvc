<?php

class Post {

    // definimos tres atributos
    // los declaramos como públicos para acceder directamente $post->author
    public $id;
    public $author;
    public $content;
    public $imagen;
    public $titulo;
    public $creado;
    public $modificado;

    public function __construct($id, $author, $content, $imagen, $titulo, $creado, $modificado) {
        $this->id = $id;
        $this->author = $author;
        $this->content = $content;
        $this->imagen = $imagen;
        $this->titulo = $titulo;
        $this->creado = $creado;
        $this->modificado = $modificado;
    }

    public static function all() {
        $list = [];
        $db = Db::getInstance(); //devuelve la conexion a la base de datos
        $req = $db->query('SELECT * FROM posts');

        // creamos una lista de objectos post y recorremos la respuesta de la
        //consulta
        foreach ($req->fetchAll() as $post) {
            $list[] = new Post($post['id'], $post['author'], $post['content'], $post['imagen'], $post['titulo'], $post['creado'], $post['modificado']);
        }
        return $list;
    }

    public static function find($id) {
        $db = Db::getInstance();
        // nos aseguramos que $id es un entero
        $id = intval($id);
        $req = $db->prepare('SELECT * FROM posts WHERE id = :id');
        // preparamos la sentencia y reemplazamos :id con el valor de $id
        $req->execute(array('id' => $id));
        $post = $req->fetch();
        return new Post($post['id'], $post['author'], $post['content'], $post['imagen'], $post['titulo'], $post['creado'], $post['modificado']);
    }

    public function insertar() {
        $author = $_POST['author'];
        $content = $_POST['post'];
        $imagen = $_POST['imagen'];
        $titulo = $_POST['titulo'];
        $creado = date('Y-m-d H:i:s');
        $modificado = date('Y-m-d H:i:s');
        $db = Db::getInstance();
        $query =$db->prepare("INSERT INTO posts
            SET author=:author, content=:content, imagen=:imagen,
                titulo=:titulo, creado=:creado, modificado=:modificado");
        
        $author = htmlspecialchars(strip_tags($author));
        $content = htmlspecialchars(strip_tags($content));
        $imagen = htmlspecialchars(strip_tags($imagen));
        $titulo = htmlspecialchars(strip_tags($titulo));
        $creado = htmlspecialchars(strip_tags($creado));
        $modificado = htmlspecialchars(strip_tags($modificado));
        
        $query->bindParam(':author', $author);
        $query->bindParam(':content', $content);
        $query->bindParam(':imagen', $imagen);
        $query->bindParam(':titulo', $titulo);
        $query->bindParam(':creado', $creado);
        $query->bindParam(":modificado", $modificado);

        $query->execute();
    }

    public function update() {
        $post = Post::find($_GET['id']);
        $id = $post->id;
        $db = Db::getInstance();
        $author = $_POST['author'];
        $content = $_POST['post'];
        $imagen = $_POST['imagen'];
        $titulo = $_POST['titulo'];
        $creado = $_POST['creado'];
        $modificado = date('Y-m-d H:i:s');

        $query = $db->prepare("UPDATE
                posts
            SET
                author = :author,
                content = :content,
                imagen = :imagen,
                titulo  = :titulo,
                creado =:creado,
                modificado =:modificado
            WHERE
                id = :id");

        $author = htmlspecialchars(strip_tags($author));
        $content = htmlspecialchars(strip_tags($content));
        $imagen = htmlspecialchars(strip_tags($imagen));
        $titulo = htmlspecialchars(strip_tags($titulo));
        $creado = htmlspecialchars(strip_tags($creado));
        $modificado = htmlspecialchars(strip_tags($modificado));
        $id = htmlspecialchars(strip_tags($id));


        // bind parameters
        $query->bindParam(':author', $author);
        $query->bindParam(':content', $content);
        $query->bindParam(':imagen', $imagen);
        $query->bindParam(':titulo', $titulo);
        $query->bindParam(':creado', $creado);
        $query->bindParam(":modificado", $modificado);
        $query->bindParam(":id", $id);

        $query->execute();
    }

}

?>