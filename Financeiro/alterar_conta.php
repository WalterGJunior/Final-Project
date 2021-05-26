<?php

require_once '../DAO/ContaDAO.php';

$objDao = new ContaDAO();

if (isset($_GET['cod']) && is_numeric($_GET['cod'])) {

    $idAccount = $_GET['cod'];

    $dados = $objDao->AccountDetail($idAccount);

    if (count($dados) == 0) {
        header('location: consultar_empresa.php');
        exit;
    }
} else if (isset($_POST['btn_salvar'])) {
    $banco = $_POST['banco'];
    $agencia = $_POST['agencia'];
    $conta = $_POST['conta'];
    $saldo = $_POST['saldo'];

    $objDao = new ContaDAO();

    $ret = $objDao->AlterAccount($banco, $agencia, $conta, $saldo);

    header('location: consultar_conta.php?ret=' . $ret);
    exit;
} else if (isset($_POST['btn_excluir'])) {

    $idAccount = $_POST['cod'];

    $ret = $objDao->DeleteAccount($idAccount);

    header('location: consultar_conta.php?ret=' . $ret);
    exit;
} else {
    header('location: consultar_conta.php');
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

                        <h2>Alterar Conta</h2>
                        <h5>Aqui você pode alterar os dados da sua Conta Bancária </h5>

                    </div>
                </div>
                <!-- /. ROW  -->
                <hr />

                <form action="alterar_conta.php" method="POST">
                    <input type="hidden" name="cod" value="<?= $dados[0]['id_account'] ?>">
                    <div class="form-group">
                        <label>Nome do Banco*:</label>
                        <input class="form-control" placeholder="Digite o nome do banco..." name="banco" id="banco" value="<?= $dados[0]['bank_name'] ?>" />
                    </div>
                    <div class="form-group">
                        <label>Agência*:</label>
                        <input class="form-control" placeholder="Digite o nome da Agência..." name="agencia" id="agencia" value="<?= $dados[0]['branch_number'] ?>" />
                    </div>
                    <div class="form-group">
                        <label>Número da Conta*:</label>
                        <input class="form-control" placeholder="Digite o Número da Conta..." name="conta" id="conta" value="<?= $dados[0]['account_number'] ?>" />
                    </div>
                    <div class="form-group">
                        <label>Saldo*:</label>
                        <input class="form-control" placeholder="Digite o Saldo..." name="saldo" id="saldo" value="<?= $dados[0]['available_founds'] ?>" />
                    </div>
                    <button type="submit" onclick="return ValidarConta()" class="btn btn-success" name="btn_salvar">Salvar</button>
                    <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#ModalDelete">Excluir</button>
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