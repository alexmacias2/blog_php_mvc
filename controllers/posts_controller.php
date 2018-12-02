<?php

class PostsController {

    public function index() {
        // Metemos todo los posts en una variable
        $posts = Post::all();
        require_once('views/posts/index.php'); //insertamos la página que nos va a mostrar los posts
    }

    public function show() {
        // esperamos a que nos pasen una url con el id 
        // si no recibimos el id redireccionamos a la página de error
        if (!isset($_GET['id'])) {
            return call('pages', 'error');
        }
        // utilizamos el id para mostrar el post que toca
        $post = Post::find($_GET['id']);
        require_once('views/posts/show.php');
    }

    public function frmInsertar() {//llamamos al formulario de ijsertar
        require_once('views/posts/mostrarInsertar.php');
    }

    public function insertar() {//Llamamos al método insertar del modelo
        Post::insertar();
        header("Location:/blog_php_mvc/index.php?controller=posts&action=frmInsertar");//redireccionamos al formulario
    }

    public function frmUpdate() {

        // utilizamos el id para obtener el post correspondiente
        $post = Post::find($_GET['id']);


        require_once('views/posts/mostrarUpdate.php');//mostramos el formulario
    }

    public function update() {
        Post::update();//Llamamos al método update del modelo
        header("Location:/blog_php_mvc/index.php?controller=posts&action=index");//redireccionamos al índice
    }

    public function delete() {
        Post::delete();//llamamos al delete del modelo
        header("Location:/blog_php_mvc/index.php?controller=posts&action=index");//redireccionamos al índice
    }

}

?>