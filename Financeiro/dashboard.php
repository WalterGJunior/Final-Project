<?php

require_once '../DAO/UtilDAO.php';
UtilDAO::VerifySession();

require_once '../DAO/TransactionDAO.php';


$dao = new TransactionDAO();

$total_earnings = $dao->TotalEarnings();
$total_expenses = $dao->TotalExpenses();
$total_categories = $dao->TotalCategory();
$total_accounts = $dao->TotalAccounts();
$total_companies = $dao->TotalCompanies();
$total_transactions = $dao->TotalTransactions();

$row = $dao->BarChartDetails();


$chart_data = "{ Earning:'" . $row[0]['earnings'] . "', Expenses:'" . $row[0]['expenses'] . "'  }";
$chart_data = substr($chart_data, 0, -2);
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
                        <h2>Dashboard</h2>
                        <h5>Here you will find the main information regards to your financial situation.</h5>

                    </div>
                </div>
                <!-- /. ROW  -->
                <hr />
                <div class="row">
                    <div class="col-md-3 col-sm-6 col-xs-6">
                        <div class="panel panel-back noti-box">
                            <span class="icon-box bg-color-red set-icon">
                                <i class="fa fa-envelope-o"></i>
                            </span>
                            <div class="text-box">
                                <p class="main-text"><?= $total_companies[0]['total'] ?></p><br>
                                <p class="text-muted">Total of Companies Registered</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3 col-sm-6 col-xs-6">
                        <div class="panel panel-back noti-box">
                            <span class="icon-box bg-color-green set-icon">
                                <i class="fa fa-bars"></i>
                            </span>
                            <div class="text-box">
                                <p class="main-text"><?= $total_categories[0]['total'] ?></p><br>
                                <p class="text-muted">Total of Categories Registered</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3 col-sm-6 col-xs-6">
                        <div class="panel panel-back noti-box">
                            <span class="icon-box bg-color-blue set-icon">
                                <i class="fa fa-bell-o"></i>
                            </span>
                            <div class="text-box">
                                <p class="main-text"><?= $total_accounts[0]['total'] ?> </p><br>
                                <p class="text-muted">Total of Accounts Registered</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3 col-sm-6 col-xs-6">
                        <div class="panel panel-back noti-box">
                            <span class="icon-box bg-color-brown set-icon">
                                <i class="fa fa-rocket"></i>
                            </span>
                            <div class="text-box">
                                <p class="main-text"><?= $total_transactions[0]['total'] ?></p><br>
                                <p class="text-muted">Total of Transactions Realized</p>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- /. ROW  -->
                <hr />
                <!-- /. ROW  -->
                <div class="row">
                    <div class="col-md-9 col-sm-12 col-xs-12">
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                Earnings / Expenses
                            </div>
                            <div class="panel-body">
                                <div id="chart"></div>
                                <script>
                                    Morris.Bar({
                                        element: 'chart',
                                        data: [<?php echo $chart_data; ?>],
                                        xkey: 'year',
                                        ykeys: ['earnings', 'expenses'],
                                        labels: ['Earrnings', 'Expenses'],
                                        hideHover: 'auto',
                                        stacked:true
                                    });
                                </script>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3 col-sm-12 col-xs-12">
                        <div class="panel panel-primary text-center no-boder bg-color-green">
                            <div class="panel-body">
                                <i class="fa fa-bar-chart-o fa-5x"></i>
                                <h3>€ <?= $total_earnings[0]['total'] != '' ? number_format($total_earnings[0]['total'], 2, ',', '.') : 0 ?> </h3>
                            </div>
                            <div class="panel-footer back-footer-green">
                                Total Cash Inflow

                            </div>
                        </div>
                        <div class="panel panel-primary text-center no-boder bg-color-red">
                            <div class="panel-body">
                                <i class="fa fa-edit fa-5x"></i>
                                <h3>€ <?= $total_expenses[0]['total'] != '' ? number_format($total_expenses[0]['total'], 2, ',', '.') : 0 ?> </h3>
                            </div>
                            <div class="panel-footer back-footer-red">
                                Total Cash Outflow

                            </div>
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