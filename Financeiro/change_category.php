<?php
require_once '../DAO/UtilDAO.php';
UtilDAO::VerifySession();

require_once '../DAO/CategoryDAO.php';

$objDao = new CategoryDAO();

if (isset($_GET['cod']) && is_numeric($_GET['cod'])){
    
    $idCategoria = $_GET['cod'];

    $dados = $objDao->CategoriesDetails($idCategoria);

    if(count($dados) == 0){
        header('location: search_category.php');
        exit;
    }

}else if (isset($_POST['btn_salvar'])) {
    $idCategoria = $_POST['cod'];
    $nome = $_POST['nome'];

   $ret = $objDao->ChangeCategory($nome, $idCategoria);

   header('location: search_category.php?ret=' . $ret);
   exit;

}else if(isset($_POST['btn_excluir'])){
    $idCategoria = $_POST['cod'];

    $ret = $objDao->DeleteCategory($idCategoria);

    header('location: search_category.php?ret=' . $ret);
    exit;

}else{
    header('location: search_category.php');
    exit;
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

                        <h2>Change Category</h2>
                        <h5>Here you can make changes in all your categories </h5>

                    </div>
                </div>
                <!-- /. ROW  -->
                <hr />

                <form action="change_category.php" method="POST">
                <input type="hidden" name="cod" value="<?= $dados[0]['id_category']?>">
                    <div class="form-group">
                        <label>Category name</label>
                        <input class="form-control" placeholder="Digite o nome da categoria. Exemplo: Conta de Luz" 
                               name="nome" id="nomecategoria" value="<?= $dados[0]['category_name']?>"  maxlength="35" />
                    </div>
                    <button type="submit" onclick="return ValidarCategoria()" class="btn btn-success" 
                            name="btn_salvar">Salve</button>
                    <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#ModalDelete">Excluir</button>
                            <div class="modal fade" id="ModalDelete" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                            <h4 class="modal-title" id="myModalLabel">Confirm the exclusion</h4>
                                        </div>
                                        <div class="modal-body">
                                            Are you sure you want to delete the <b>"<?=$dados[0]['category_name']?>"</b> category? 
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                                            <button type="submit" class="btn btn-primary" name="btn_excluir">Yes</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                </form>
            </div>
            <!-- /. PAGE INNER  -->
        </div>
        <!-- /. PAGE WRAPPER  -->
    </div>
    <!-- /. WRAPPER  -->



</body>

</html>