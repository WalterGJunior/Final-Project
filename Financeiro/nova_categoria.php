<?php
require_once '../DAO/UtilDAO.php';
UtilDAO::VerifySession();

require_once '../DAO/CategoriaDAO.php';

if (isset($_POST['btn_gravar'])) {
    $nome = $_POST['nome'];

    $objDao = new CategoriaDAO();

    $ret = $objDao->CadastrarCategoria($nome);
}
?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">

<?php
include_once '_head.php';
?>

<body>
    <div id="wrapper">

        <?php
        include_once '_topo.php';
        include_once '_navbar.php';
        ?>

        <!-- /. NAV SIDE  -->
        <div id="page-wrapper">
            <div id="page-inner">
                <div class="row">
                    <div class="col-md-12">

                        <?php include_once '_msg.php'; ?>

                        <h2>New Category</h2>
                        <h5> Here you can register new categories to be used in your transactions </h5>
                    </div>
                </div>
                <!-- /. ROW  -->
                <hr />

                <form action="nova_categoria.php" method="POST">
                    <div class="form-group">
                        <label>Category Name</label>
                        <input class="form-control" placeholder="Type the category name" name="nome" id="nomecategoria" maxlength="35"/>
                    </div>
                    <button type="submit" onclick="return ValidarCategoria()" class="btn btn-success" name="btn_gravar">Salve</button>
                </form>
            </div>
            <!-- /. PAGE INNER  -->
        </div>
        <!-- /. PAGE WRAPPER  -->
    </div>
    <!-- /. WRAPPER  -->



</body>

</html>