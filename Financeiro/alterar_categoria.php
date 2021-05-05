<?php

require_once '../DAO/CategoriaDAO.php';

if (isset($_POST['btn_salvar'])) {
    $nome = $_POST['nome'];

    $objDao = new CategoriaDAO();

    $ret = $objDao->AlterarCategoria($nome);
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

                        <h2>Alterar Categoria</h2>
                        <h5>Aqui você alterar ou excluir suas categorias </h5>

                    </div>
                </div>
                <!-- /. ROW  -->
                <hr />

                <form action="alterar_categoria.php" method="POST">
                    <div class="form-group">
                        <label>Nome da Categoria</label>
                        <input class="form-control" placeholder="Digite o nome da categoria. Exemplo: Conta de Luz" name="nome" id="nomecategoria" />
                    </div>
                    <button type="submit" onclick="return ValidarCategoria()" class="btn btn-success" name="btn_salvar">Salvar</button>
                    <button type="submit" class="btn btn-danger" name="btn_excluir">Excluir</button>
                </form>
            </div>
            <!-- /. PAGE INNER  -->
        </div>
        <!-- /. PAGE WRAPPER  -->
    </div>
    <!-- /. WRAPPER  -->



</body>

</html>