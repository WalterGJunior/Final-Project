<?php

require_once '../DAO/UtilDAO.php';
UtilDAO::VerifySession();

require_once '../DAO/MovimentoDAO.php';


$dao = new MovimentoDAO();

$total_earnings = $dao->TotalEarnings();
$total_expenses = $dao->TotalExpenses();

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

                        <h2>Dashboard</h2>
                        <h5>On this page you can see all your transactions. </h5>

                    </div>
                </div>
                <!-- /. ROW  -->
                <hr />
                <div class="col-md-6">
                        <div class="panel panel-primary text-center no-boder bg-color-green">
                            <div class="panel-body">
                                <i class="fa fa-bar-chart-o fa-5x"></i>
                                <h3>€ <?= $total_earnings[0]['total'] != '' ? number_format($total_earnings[0]['total'], 2, ',', '.') : 0 ?>  </h3>
                            </div>
                            <div class="panel-footer back-footer-green">
                                Total de Entradas

                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="panel panel-primary text-center no-boder bg-color-red">
                            <div class="panel-body">
                                <i class="fa fa-bar-chart-o fa-5x"></i>
                                <h3>€ <?= $total_expenses[0]['total'] != '' ? number_format($total_expenses[0]['total'], 2, ',', '.') : 0 ?> </h3>
                            </div>
                            <div class="panel-footer back-footer-red">
                                Total de Saídas

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