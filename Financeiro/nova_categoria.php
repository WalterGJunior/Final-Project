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

                        <h2>Nova Categoria</h2>
                        <h5>Aqui você poderá cadastrar todas as categorias </h5>

                    </div>
                </div>
                <!-- /. ROW  -->
                <hr />

                <form action="nova_categoria.php" method="POST">
                    <div class="form-group">
                        <label>Nome da Categoria</label>
                        <input class="form-control" placeholder="Digite o nome da categoria" name="nome" id="nomecategoria"/>
                    </div>
                    <button type="submit" onclick="return ValidarCategoria()" class="btn btn-success" name="btn_gravar">Gravar</button>
                </form>
            </div>
            <!-- /. PAGE INNER  -->
        </div>
        <!-- /. PAGE WRAPPER  -->
    </div>
    <!-- /. WRAPPER  -->



</body>

</html>