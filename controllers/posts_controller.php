<?php

class PostsController {

    public function index() {
        // Guardamos todos los posts en una variable
        $posts = Post::all();
        require_once('views/posts/index.php');
    }

    public function show() {
        // esperamos una url del tipo ?controller=posts&action=show&id=x
        // si no nos pasan el id redirecionamos hacia la pagina de error, el id
        //tenemos que buscarlo en la BBDD
        if (!isset($_GET['id'])) {
            return call('pages', 'error');
        }
        // utilizamos el id para obtener el post correspondiente
        $post = Post::find($_GET['id']);
        require_once('views/posts/show.php');
    }

    public function frmInsertar() {
        require_once('views/posts/mostrarInsertar.php');
    }

    public function insertar() {
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

}

?>