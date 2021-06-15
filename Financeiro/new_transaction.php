<?php
require_once '../DAO/UtilDAO.php';
UtilDAO::VerifySession();


require_once '../DAO/TransactionDAO.php';
require_once '../DAO/AccountDAO.php';
require_once '../DAO/CompanyDAO.php';
require_once '../DAO/CategoryDAO.php';

$dao_category = new CategoryDAO();
$dao_company = new CompanyDAO();
$dao_account = new AccountDAO();

if (isset($_POST['btn_gravar'])) {
    $tipo = $_POST['tipo'];
    $data = $_POST['data'];
    $valor = $_POST['valor'];
    $categoria = $_POST['categoria'];
    $empresa = $_POST['empresa'];
    $conta = $_POST['conta'];
    $obs = $_POST['obs'];

    $objDao = new TransactionDAO();

    $ret = $objDao->CreateTransaction($tipo, $data, $valor, $categoria, $empresa, $conta, $obs);
}

$categories = $dao_category ->SearchCategory();
$companies = $dao_company -> SearchCompany();
$accounts = $dao_account -> SearchAccount();

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

                        <h2>Make a new Transaction</h2>
                        <h5> Here you can make new transactions regards all your cash inflow and outflow. </h5>
                    </div>
                </div>
                <!-- /. ROW  -->
                <hr />

                <form action="realizar_movimento.php" method="POST">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Type:</label>
                            <select class="form-control" name="tipo" id="tipo">
                                <option value="">Select</option>
                                <option value="1">Earnings</option>
                                <option value="2">Expenses</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Date*</label>
                            <input type="date" name="data" class="form-control" id="data"/>
                        </div>
                        <div class="form-group">
                            <label>Ammount:</label>
                            <input class="form-control" name="valor" placeholder="Type the ammount transaction" id="valor"/>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Category:</label>
                            <select class="form-control" name="categoria" id="data">
                                <option value="">Select</option>
                                <?php foreach($categories as $item){?>
                                    <option value="<?= $item['id_category']?>">
                                        <?= $item['category_name']?>
                                    </option>
                                <?php }?>
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Company:</label>
                            <select class="form-control" name="empresa" id="empresa">
                                <option value="">Select</option>
                                <?php foreach($companies as $item){?>
                                    <option value="<?= $item['id_company']?>">
                                        <?= $item['company_name']?>
                                    </option>
                                <?php }?>
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Account:</label>
                            <select class="form-control" name="conta" id="conta">
                                <option value="">Select</option>
                                <?php foreach($accounts as $item){?>
                                    <option value="<?= $item['id_account']?>">
                                        <?= 'Bank Name: ' . $item['bank_name'] . ', Branch Number: ' . $item['branch_number'] . ' / ' . $item['account_number'] . ', Available Funds: ' . $item['available_founds']?>
                                    </option>
                                <?php }?>
                            </select>
                        </div>
                    </div>

                    <div class="col-md-12">
                        <div class="form-group">
                            <label>Comments (Optional)</label>
                            <textarea class="form-control" rows="3" name="obs"></textarea>
                        </div>
                        <button type="submit" onclick="return ValidarMovimento()" class="btn btn-success" name="btn_gravar">Gravar</button>

                    </div>
                </form>
                <!-- /. PAGE INNER  -->
            </div>
            <!-- /. PAGE WRAPPER  -->
        </div>
        <!-- /. WRAPPER  -->



</body>

</html>