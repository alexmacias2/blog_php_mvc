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
    
    public function insertar(){
        $author = $_POST['author'];
        $content = $_POST['post'];
        $imagen = $_POST['imagen'];
        $titulo = $_POST['titulo'];
        $creado = $_POST['creado'];
        $modificado = $_POST['modificado'];
        $db = Db::getInstance();
        $req = $db->prepare("INSERT INTO posts ( author, content, imagen, titulo, creado, modificado) VALUES ( '$author', '$content', '$imagen', '$titulo', '$creado', '$modificado'); ");
        $req->execute();
    } 
    public function update(){
        $post = Post::find($_GET['id']);
        $id=$post->id;
        $author = $_POST['author'];
        $content = $_POST['post'];
        $imagen = $_POST['imagen'];
        $titulo = $_POST['titulo'];
        $creado = $_POST['creado'];
        $modificado = $_POST['modificado'];
        echo $id;
        echo $author;
        echo $content;
        echo $imagen;
        echo $modificado;
        echo $titulo;
        echo $creado;
    }
    
    
    

}

?>