<?php
require_once '../DAO/UtilDAO.php';
UtilDAO::VerifySession();

require_once '../DAO/ContaDAO.php';

if (isset($_POST['btn_gravar'])) {
    $banco = $_POST['banco'];
    $agencia = $_POST['agencia'];
    $conta = $_POST['conta'];
    $saldo = $_POST['saldo'];

    $objDao = new ContaDAO();

    $ret = $objDao->CadastrarConta($banco, $agencia, $conta, $saldo);
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
                <form action="nova_conta.php" method="POST">
                <div class="form-group">
                    <label>Bank name*:</label>
                    <input class="form-control" placeholder="Type the Bank name..." name="banco" id="banco"/>
                </div>
                <div class="form-group">
                    <label>Branch number*:</label>
                    <input class="form-control" placeholder="Type the Branch number..." name="agencia" id="agencia"/>
                </div>
                <div class="form-group">
                    <label>Account Number*:</label>
                    <input class="form-control" placeholder="Type the Account Number..." name="conta" id="name"/>
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