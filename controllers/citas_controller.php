<?php

class CitasController { //controlador de la tabla citas

    public function index() {
        $citas = Cita::all();//Guardamos todos las citas
        require_once('views/citas/index.php');
    }

    public function show() {
        // esperamos a que nos pasen una url con el id 
        // si no recibimos el id redireccionamos a la página de error
        if (!isset($_GET['id'])) {
            return call('pages', 'error');
        }
        // mediante el id mostraremos la cita que toca
        $citas = Cita::find($_GET['id']);
        require_once('views/citas/show.php');
    }

    public function frmInsertar() {//Simplemente llamamos al formulario de insertar
        require_once('views/citas/mostrarInsertar.php');
    }

    public function insertar() {//El anterior formulario nos lleva a este método que llamar al insertar del modelo
        Cita::insertar();
        header("Location:/blog_php_mvc/index.php?controller=citas&action=frmInsertar");
    }

    public function frmUpdate() {

        $citas = Cita::find($_GET['id']);//cogemos el id para saber que cita vamos a actualizar
        require_once('views/citas/mostrarUpdate.php');//vamos al formulario
    }

    public function update() {
        Cita::update();//llamamos al método update del modelo
        header("Location:/blog_php_mvc/index.php?controller=citas&action=index");//redireccionamos al índice
    }
    
    public function delete(){
        Cita::delete();//llamamos al método borrar del modelo
        header("Location:/blog_php_mvc/index.php?controller=citas&action=index");//redireccionamos al índice
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