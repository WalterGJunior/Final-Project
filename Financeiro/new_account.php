<?php
require_once '../DAO/UtilDAO.php';
UtilDAO::VerifySession();

require_once '../DAO/AccountDAO.php';

if (isset($_POST['btn_gravar'])) {
    $banco = $_POST['banco'];
    $conta = $_POST['conta'];
    $bic = $_POST['bic'];
    $saldo = $_POST['saldo'];

    $objDao = new AccountDAO();

    $ret = $objDao->CreateAccount($banco, $bic, $conta, $saldo);
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

                        <h2>New Account</h2>
                        <h5>Here you can register a new bank account to be used in your transactions  </h5>

                    </div>
                </div>
                <!-- /. ROW  -->
                <hr />
                <form action="new_account.php" method="POST">
                <div class="form-group">
                    <label>Bank name*:</label>
                    <input class="form-control" placeholder="Type the Bank name..." name="banco" id="banco"/>
                </div>
                <div class="form-group">
                    <label>Account number*:</label>
                    <input class="form-control" placeholder="Type the Account number..." name="conta" id="conta"/>
                </div>
                <div class="form-group">
                    <label>Bank Identifier Code ( BIC )*:</label>
                    <input class="form-control" placeholder="Type the BIC Number..." name="bic" id="bic"/>
                </div>
                <div class="form-group">
                    <label>Available funds*:</label>
                    <input class="form-control" placeholder="Type the available funds..." name="saldo" id="saldo"/>
                </div>
                <button type="submit" onclick="return ValidarConta()" class="btn btn-success" name="btn_gravar">Salve</button>
                </form>
            </div>
            <!-- /. PAGE INNER  -->
        </div>
        <!-- /. PAGE WRAPPER  -->
    </div>
    <!-- /. WRAPPER  -->



</body>

</html>