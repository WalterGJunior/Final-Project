<?php
require_once '../DAO/UtilDAO.php';
UtilDAO::VerifySession();

require_once '../DAO/ContaDAO.php';

$objDao = new ContaDAO();
$Accounts = $objDao->SearchAccount();

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
                        <h2>Consultar Contas</h2>
                        <h5>Consulte todas as contas aqui </h5>

                    </div>
                </div>
                <!-- /. ROW  -->
                <hr />

                <div class="panel panel-default">
                        <div class="panel-heading">
                             Contas Cadastradas. Caso deseje alterar, clique no botão. 
                        </div>
                        <div class="panel-body">
                            <div class="table-responsive">
                                <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                                    <thead>
                                        <tr>
                                            <th>Banco</th>
                                            <th>Agência</th>
                                            <th>Número da Conta</th>
                                            <th>Saldo</th>
                                            <th>Ação</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    <?php for($i = 0; $i<count($Accounts);$i++) { ?>
                                        <tr class="odd gradeX">
                                            <td><?= $Accounts[$i]['bank_name']?></td>
                                            <td><?= $Accounts[$i]['branch_number']?></td>
                                            <td><?= $Accounts[$i]['account_number']?></td>
                                            <td><?= $Accounts[$i]['available_founds']?></td>                                            
                                            <td>
                                                <a href="alterar_conta.php?cod=<?=$Accounts[$i]['id_account']?>" class="btn btn-warning btn-sm">Alterar</a>
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