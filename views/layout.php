<DOCTYPE html>
    <html>
        <head>
        </head>
        <body>
            <header>
                <a href='/blog_php_mvc'>Home</a>
                <a href='?controller=posts&action=index'>Posts</a>
                <a href='?controller=citas&action=index'>Citas</a>
                <a href='?controller=posts&action=frmInsertar'>InsertarPosts</a>
                <a href='?controller=citas&action=frmInsertar'>InsertarCitas</a>
            </header>
            
            <?php require_once('routes.php'); ?>
            
            <footer>
                Copyright
            </footer>
        </body>
    </html>

