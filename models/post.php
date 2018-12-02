<?php

class Post {//Clase modelo de la tabla posts

   //definimos los atributos del modelo
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
        $db = Db::getInstance(); 
        $req = $db->query('SELECT * FROM posts');

        //guardamos los valores de la tabla
        foreach ($req->fetchAll() as $post) {
            $list[] = new Post($post['id'], $post['author'], $post['content'], $post['imagen'], $post['titulo'], $post['creado'], $post['modificado']);
        }
        return $list;//retornamos la lista de posts
    }

    public static function find($id) {
        $db = Db::getInstance();
        $id = intval($id);//el id debe ser un entero
        $req = $db->prepare('SELECT * FROM posts WHERE id = :id');//preparamos la sentencia
        $req->execute(array('id' => $id));//ejecutamos seteando el id
        $post = $req->fetch();
        return new Post($post['id'], $post['author'], $post['content'], $post['imagen'], $post['titulo'], $post['creado'], $post['modificado']);
    }

    public function insertar() {//metodo que hara el insert
        //guardamos los valores del formulario en variables
        $author = $_POST['author'];
        $content = $_POST['post'];
        $imagen = $_FILES['imagen']['tmp_name'];
        $imagen = file_get_contents($_FILES['imagen']['tmp_name']);
        $titulo = $_POST['titulo'];
        $creado = date('Y-m-d H:i:s');
        $modificado = date('Y-m-d H:i:s');//las fechas de creación y modificación se asignaran según la fecha actual además le damos formato
        $db = Db::getInstance();
        $query = $db->prepare("INSERT INTO posts
            SET author=:author, content=:content, imagen=:imagen,
                titulo=:titulo, creado=:creado, modificado=:modificado");//preparamos la sentencia
        //Nos aseguramos de que no hya etiquetas
        $author = htmlspecialchars(strip_tags($author));
        $content = htmlspecialchars(strip_tags($content));
        $titulo = htmlspecialchars(strip_tags($titulo));
        $creado = htmlspecialchars(strip_tags($creado));
        $modificado = htmlspecialchars(strip_tags($modificado));
        //seteamos los valroes en la consulta
        $query->bindParam(':author', $author);
        $query->bindParam(':content', $content);
        $query->bindParam(':imagen', $imagen);
        $query->bindParam(':titulo', $titulo);
        $query->bindParam(':creado', $creado);
        $query->bindParam(":modificado", $modificado);

        $query->execute();//ejecutamos
    }

    public function update() {//metodo que hara el update
        $post = Post::find($_GET['id']);//guardamos el id
        $id = $post->id;
        $db = Db::getInstance();
        $author = $_POST['author'];
        $content = $_POST['post'];
        $imagen = $_FILES['imagen']['tmp_name'];
        $imagen = file_get_contents($_FILES['imagen']['tmp_name']);//la imagen se guarda en files
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
        //quitamos etiquetas
        $author = htmlspecialchars(strip_tags($author));
        $content = htmlspecialchars(strip_tags($content));
        $titulo = htmlspecialchars(strip_tags($titulo));
        $creado = htmlspecialchars(strip_tags($creado));
        $modificado = htmlspecialchars(strip_tags($modificado));
        $id = htmlspecialchars(strip_tags($id));


        // seteamos los valores
        $query->bindParam(':author', $author);
        $query->bindParam(':content', $content);
        $query->bindParam(':imagen', $imagen);
        $query->bindParam(':titulo', $titulo);
        $query->bindParam(':creado', $creado);
        $query->bindParam(":modificado", $modificado);
        $query->bindParam(":id", $id);

        $query->execute();//ejecutamos
    }

    public function delete() {//metodo que hara el delete
        $post = Post::find($_GET['id']);
        $db = Db::getInstance();
        $query = $db->prepare("DELETE FROM posts WHERE id = ?");
        $query->bindParam(1, $post->id);
        $query->execute();
    }

}

?>