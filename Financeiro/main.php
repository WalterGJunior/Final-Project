<?php

require_once '../DAO/UtilDAO.php';
UtilDAO::VerifySession();

require_once '../DAO/MovimentoDAO.php';


$dao = new MovimentoDAO();

$total_earnings = $dao->TotalEarnings();
$total_expenses = $dao->TotalExpenses();

$transaction = $dao->ShowLatestTransactions();
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
                            <h3>€ <?= $total_earnings[0]['total'] != '' ? number_format($total_earnings[0]['total'], 2, ',', '.') : 0 ?> </h3>
                        </div>
                        <div class="panel-footer back-footer-green">
                            Total Cash Inflow

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
                            Total Cash Outflow

                        </div>
                    </div>
                </div>

                <hr />

                <?php if (count($transaction) > 0) { ?>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    Last 10 Transactions
                                </div>
                                <div class="panel-body">
                                    <div class="table-responsive">
                                        <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                                            <thead>
                                                <tr>
                                                    <th>Date</th>
                                                    <th>Type</th>
                                                    <th>Category</th>
                                                    <th>Company</th>
                                                    <th>Account</th>
                                                    <th>Ammount</th>
                                                    <th>Comments</th>

                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                $total = 0;
                                                for ($i = 0; $i < count($transaction); $i++) {
                                                    if ($transaction[$i]['transaction_type'] == 1) {
                                                        $total = $total + $transaction[$i]['transactions_amount'];
                                                    } else {
                                                        $total = $total - $transaction[$i]['transactions_amount'];
                                                    }
                                                ?>
                                                    <tr class="odd gradeX">
                                                        <td><?= $transaction[$i]['transactions_date'] ?></td>
                                                        <td><?= $transaction[$i]['transaction_type'] == 1 ? 'Earnings' : 'Expenses' ?></td>
                                                        <td><?= $transaction[$i]['category_name'] ?></td>
                                                        <td><?= $transaction[$i]['company_name'] ?></td>
                                                        <td><?= $transaction[$i]['bank_name'] ?> / Ag. <?= $transaction[$i]['branch_number'] ?> - Num.<?= $transaction[$i]['account_number'] ?> </td>
                                                        <td>€ <?= number_format($transaction[$i]['transactions_amount'], 2, ',', '.') ?></td>
                                                        <td><?= $transaction[$i]['transaction_comments'] ?></td>

                                                    </tr>
                                                <?php } ?>
                                            </tbody>
                                        </table>
                                        <center>
                                            <label style="color: <?= $total < 0 ? 'red' : 'green' ?>;">TOTAL: €<?= number_format($total, 2, ',', '.'); ?> </label>
                                        </center>
                                    </div>

                                </div>
                            </div>

                        </div>
                    </div>
                <?php } else { ?>
                    <center>
                        <div class="alert alert-info col-md-12">
                            No transactions were found;
                        </div>
                    </center>
                <?php } ?>

            </div>
            <!-- /. PAGE INNER  -->
        </div>
        <!-- /. PAGE WRAPPER  -->
    </div>
    <!-- /. WRAPPER  -->



</body>

</html>