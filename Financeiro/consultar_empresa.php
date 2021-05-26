<?php

require_once '../DAO/EmpresaDAO.php';

$objDao = new EmpresaDAO();
$companies = $objDao->SearchCompany();

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

                                    <?php for($i = 0; $i<count($companies);$i++) { ?>

                                        <tr class="odd gradeX">
                                            <td><?= $companies[$i]['company_name']?></td>
                                            <td><?= $companies[$i]['telephone_number']?></td>
                                            <td><?= $companies[$i]['company_address']?></td>
                                            <td>
                                                <a href="alterar_empresa.php?cod=<?=$companies[$i]['id_company']?>" class="btn btn-warning btn-sm">Alterar</a>
                                            </td>
                                        </tr> 
                                    <?php }?>                                       
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