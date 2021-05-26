<?php

    require_once '../DAO/CategoriaDAO.php';

    $dao = new CategoriaDAO();
    $categories = $dao->Consultarcategoria();

    //echo '<pre>';
    //print_r($categories);
    //echo '</pre>';
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
                        <?php include_once '_msg.php'?>
                        <h2>Consultar Categorias</h2>
                        <h5>Consulte todas as Categorias </h5>

                    </div>
                </div>
                <!-- /. ROW  -->
                <hr />

                <div class="panel panel-default">
                        <div class="panel-heading">
                             Categorias Cadastradas. Caso deseje alterar, clique no botão. 
                        </div>
                        <div class="panel-body">
                            <div class="table-responsive">
                                <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                                    <thead>
                                        <tr>
                                            <th>Nome da Categoria</th>
                                            <th>Ação</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php foreach($categories as $item){ ?>
                                        <tr class="odd gradeX">
                                            <td><?= $item['category_name']?></td>
                                            <td>
                                                <a href="alterar_categoria.php?cod=<?= $item['id_category']?>" class="btn btn-warning btn-sm">Alterar</a>
                                            </td>
                                        </tr>
                                        <?php } ?>                                        
                                    </tbody>
                                </table>
                            </div>
                            
                        </div>
                    </div>

            </div>
            <!-- /. PAGE INNER  -->
        </div>
        <!-- /. PAGE WRAPPER  -->
    </div>
    <!-- /. WRAPPER  -->



</body>

</html>