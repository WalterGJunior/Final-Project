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
                        <h2>Consultar Empresas</h2>
                        <h5>Consulte todas as empresas aqui </h5>

                    </div>
                </div>
                <!-- /. ROW  -->
                <hr />

                <div class="panel panel-default">
                        <div class="panel-heading">
                             Empresas Cadastradas. Caso deseje alterar, clique no botão. 
                        </div>
                        <div class="panel-body">
                            <div class="table-responsive">
                                <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                                    <thead>
                                        <tr>
                                            <th>Nome da Categoria</th>
                                            <th>Telefone</th>
                                            <th>Endereço</th>
                                            <th>Ação</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr class="odd gradeX">
                                            <td>(Nome)</td>
                                            <td>(Telefone)</td>
                                            <td>(Endereço)</td>
                                            <td>
                                                <a href="alterar_empresa.php" class="btn btn-warning btn-sm">Alterar</a>
                                            </td>
                                        </tr>                                        
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