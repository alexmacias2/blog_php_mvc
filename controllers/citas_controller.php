<?php

class CitasController {

    public function index() {
        // Guardamos todos los posts en una variable
        $citas = Cita::all();
        require_once('views/citas/index.php');
    }

    public function show() {
        // esperamos una url del tipo ?controller=posts&action=show&id=x
        // si no nos pasan el id redirecionamos hacia la pagina de error, el id
        //tenemos que buscarlo en la BBDD
        if (!isset($_GET['id'])) {
            return call('pages', 'error');
        }
        // utilizamos el id para obtener el post correspondiente
        $citas = Cita::find($_GET['id']);
        require_once('views/citas/show.php');
    }

    public function frmInsertar() {
        require_once('views/citas/mostrarInsertar.php');
    }

    public function insertar() {
        Cita::insertar();
        header("Location:/blog_php_mvc/index.php?controller=citas&action=frmInsertar");
    }
//
//    public function frmUpdate() {
//
//        // utilizamos el id para obtener el post correspondiente
//        $post = Post::find($_GET['id']);
//
//
//        require_once('views/posts/mostrarUpdate.php');
//    }
//
//    public function update() {
//        Post::update();
//        header("Location:/blog_php_mvc/index.php?controller=posts&action=index");
//    }
//
//    public function delete() {
//        Post::delete();
//        header("Location:/blog_php_mvc/index.php?controller=posts&action=index");
//    }

}

?>