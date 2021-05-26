<?php

require_once '../DAO/MovimentoDAO.php';

$initial_date = '';
$final_date = '';
$type = '';

if (isset($_POST['btn_search'])) {
    $type = $_POST['type'];
    $initial_date = $_POST['initial_date'];
    $final_date = $_POST['final_date'];

    $objDao = new MovimentoDAO();

    $transaction = $objDao->SearchTransaction($type, $initial_date, $final_date);

}else if(isset($_POST['btn_excluir'])){

    $id_transaction = $_POST['id_transaction'];
    $id_account = $_POST['id_account'];
    $amount = $_POST['amount'];
    $type = $_POST['type'];

    $objDao = new MovimentoDAO();

    $ret = $objDao->DeleteTransaction($id_transaction, $id_account, $amount, $type);

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

                        <h2>Consultar Movimento</h2>
                        <h5>Consulte todos as movimentos em um determinado período </h5>

                    </div>
                </div>
                <!-- /. ROW  -->
                <hr />

                <form method="POST" action="consultar_movimento.php">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label>Tipo do Movimento:</label>
                            <select class="form-control" name="type">
                                <option value="0" <?= $type == '0' ? 'selected' : '' ?>>TODOS</option>
                                <option value="1" <?= $type == '1' ? 'selected' : '' ?>>Entrada</option>
                                <option value="2" <?= $type == '2' ? 'selected' : '' ?>>Saídas</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Data Inicial*</label>
                            <input type="date" class="form-control" placeholder="Coloque a data do movimento" id="dataInicial" name="initial_date" value="<?= $initial_date ?>" />
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Data Final*</label>
                            <input type="date" class="form-control" placeholder="Coloque a data do movimento" id="dataFinal" name="final_date" value="<?= $final_date ?>" />
                        </div>
                    </div>

                    <center>
                        <button class="btn btn-info" onclick="return ValidarConsultarMovimento()" name="btn_search"> Pesquisar </button>
                    </center>
                </form>
                <hr />
                <?php if (isset($transaction)) { ?>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    Resultados Encontrados
                                </div>
                                <div class="panel-body">
                                    <div class="table-responsive">
                                        <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                                            <thead>
                                                <tr>
                                                    <th>Data</th>
                                                    <th>Tipo</th>
                                                    <th>Categoria</th>
                                                    <th>Empresa</th>
                                                    <th>Conta</th>
                                                    <th>Valor</th>
                                                    <th>Observação</th>
                                                    <th>Ação</th>
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
                                                        <td>
                                                            <button type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#ModalDelete<?= $i?>">Excluir</button>

                                                            <form method="POST" action="consultar_movimento.php">
                                                                <input type="hidden" name="id_transaction" value="<?=$transaction[$i]['id_transactions'] ?>"/>
                                                                <input type="hidden" name="id_account" value="<?=$transaction[$i]['fk_id_account'] ?>"/>
                                                                <input type="hidden" name="amount" value="<?=$transaction[$i]['transactions_amount'] ?>"/>
                                                                <input type="hidden" name="type" value="<?=$transaction[$i]['transaction_type'] ?>"/>

                                                                <div class="modal fade" id="ModalDelete<?= $i?>" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                                                                    <div class="modal-dialog">
                                                                        <div class="modal-content">
                                                                            <div class="modal-header">
                                                                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                                                                <h4 class="modal-title" id="myModalLabel">Confirm the exclusion</h4>
                                                                            </div>
                                                                            <div class="modal-body">
                                                                                <center><b>Are you sure you want to delete this transactions?<b></center> <br><br>
                                                                                <b>Transaction Date :</b> <?= $transaction[$i]['transactions_date'] ?><br>
                                                                                <b>Transaction Type :</b> <?= $transaction[$i]['transaction_type'] == 1 ? 'Earnings' : 'Expenses' ?><br>
                                                                                <b>Category :</b> <?= $transaction[$i]['category_name'] ?><br>
                                                                                <b>Company Name :</b> <?= $transaction[$i]['company_name'] ?><br>
                                                                                <b>Account :</b> <?= $transaction[$i]['bank_name'] ?> / Ag. <?= $transaction[$i]['branch_number'] ?> - Num.<?= $transaction[$i]['account_number'] ?> <br>
                                                                                <b>Amount :</b>€ <?= number_format($transaction[$i]['transactions_amount'], 2, ',', '.') ?><br>
                                                                            </div>
                                                                            <div class="modal-footer">
                                                                                <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                                                                                <button type="submit" class="btn btn-primary" name="btn_excluir">Yes</button>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </form>

                                                        </td>
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
                <?php } ?>
            </div>
            <!-- /. PAGE INNER  -->
        </div>
        <!-- /. PAGE WRAPPER  -->
    </div>
    <!-- /. WRAPPER  -->



</body>

</html>