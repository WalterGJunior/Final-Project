<?php
require_once '../DAO/UtilDAO.php';
UtilDAO::VerifySession();

require_once '../DAO/AccountDAO.php';

$objDao = new AccountDAO();

if (isset($_GET['cod']) && is_numeric($_GET['cod'])) {

    $idAccount = $_GET['cod'];

    $dados = $objDao->AccountDetail($idAccount);

    if (count($dados) == 0) {
        header('location: search_company.php');
        exit;
    }
} else if (isset($_POST['btn_salvar'])) {
    $idAccount = $_POST['cod'];
    $banco = $_POST['banco'];
    $bic = $_POST['bic'];
    $conta = $_POST['conta'];
    $saldo = $_POST['saldo'];

    $objDao = new AccountDAO();

    $ret = $objDao->AlterAccount($idAccount, $banco, $bic, $conta, $saldo);
    
    header('location: search_account.php?ret=' . $ret);
    exit;
} else if (isset($_POST['btn_excluir'])) {

    $idAccount = $_POST['cod'];

    $ret = $objDao->DeleteAccount($idAccount);

    header('location: search_account.php?ret=' . $ret);
    exit;
} else {
    header('location: search_account.php');
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

                        <h2>Change you Account</h2>
                        <h5>Here you can make changes in your Bank Account </h5>

                    </div>
                </div>
                <!-- /. ROW  -->
                <hr />

                <form action="change_account.php" method="POST">
                    <input type="hidden" name="cod" value="<?= $dados[0]['id_account'] ?>">
                    <div class="form-group">
                        <label>Bank name*:</label>
                        <input class="form-control" placeholder="Type the Bank name..." name="banco" id="banco" value="<?= $dados[0]['bank_name'] ?>" />
                    </div>
                    <div class="form-group">
                        <label>Bank Identifier Code ( BIC ):</label>
                        <input class="form-control" placeholder="Type the BIC code..." name="bic" id="bic" value="<?= $dados[0]['bic_number'] ?>" />
                    </div>
                    <div class="form-group">
                        <label>Account number*:</label>
                        <input class="form-control" placeholder="Type the Account number..." name="conta" id="conta" value="<?= $dados[0]['account_number'] ?>" />
                    </div>                    
                    <div class="form-group">
                        <label>Available funds*:</label>
                        <input class="form-control" placeholder="Digite o Saldo..." name="saldo" id="saldo" value="<?= $dados[0]['available_funds'] ?>" />
                    </div>
                    <button type="submit" onclick="return ValidarConta()" class="btn btn-success" name="btn_salvar">Save</button>
                    <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#ModalDelete">Delete</button>
                    <div class="modal fade" id="ModalDelete" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                    <h4 class="modal-title" id="myModalLabel">Confirm the exclusion</h4>
                                </div>
                                <div class="modal-body">
                                    Are you sure you want to delete the <b>"<?= $dados[0]['bank_name'] ?>"</b> Account?
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                                    <button type="submit" class="btn btn-primary" name="btn_excluir">Yes</button>
                                </div>
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