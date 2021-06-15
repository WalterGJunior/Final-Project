<?php
require_once '../DAO/UtilDAO.php';
UtilDAO::VerifySession();

require_once '../DAO/CompanyDAO.php';

$objDao = new CompanyDAO();

if (isset($_GET['cod']) && is_numeric($_GET['cod'])) {

    $idEmpresa = $_GET['cod'];

    $dados = $objDao->CompanyDetail($idEmpresa);

    if (count($dados) == 0) {
        header('location: consultar_empresa.php');
        exit;
    }
} else if (isset($_POST['btn_salvar'])) {
    $idEmpresa = $_POST['cod'];
    $companyName = $_POST['empresa'];
    $telephoneCompany = $_POST['telefone'];
    $companyAddress = $_POST['endereco'];

    $objDao = new CompanyDAO();

    $ret = $objDao->ChangeCompany($idEmpresa, $companyName, $telephoneCompany, $companyAddress);

    header('location: consultar_empresa.php?ret=' . $ret);
    exit;
} else if (isset($_POST['btn_excluir'])) {

    $idEmpresa = $_POST['cod'];

    $ret = $objDao->DeleteCompany($idEmpresa);

    header('location: consultar_empresa.php?ret=' . $ret);
    exit;
} else {
    header('location: consultar.empresa.php');
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

                        <h2>Alterar Empresa</h2>
                        <h5>Cadastre aqui todas as suas empresas </h5>

                    </div>
                </div>
                <!-- /. ROW  -->
                <hr />

                <form action="alterar_empresa.php" method="POST">
                    <input type="hidden" name="cod" value="<?= $dados[0]['id_company'] ?>">
                    <div class="form-group">
                        <label>Nome da empresa*:</label>
                        <input class="form-control" placeholder="Digite aqui..." name="empresa" id="nomeempresa" value="<?= $dados[0]['company_name'] ?>" />
                    </div>
                    <div class="form-group">
                        <label>Telefone:</label>
                        <input class="form-control" placeholder="Digite aqui..." name="telefone" value="<?= $dados[0]['telephone_number'] ?>" />
                    </div>
                    <div class="form-group">
                        <label>Endereço:</label>
                        <input class="form-control" placeholder="Digite aqui..." name="endereco" value="<?= $dados[0]['company_address'] ?>" />
                    </div>
                    <button type="submit" onclick="return ValidarEmpresa()" class="btn btn-success" name="btn_salvar">Salvar</button>
                    <button type="button" class="btn btn-danger " data-toggle="modal" data-target="#ModalDelete">Excluir</button>
                    <div class="modal fade" id="ModalDelete" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                    <h4 class="modal-title" id="myModalLabel">Confirm the exclusion</h4>
                                </div>
                                <div class="modal-body">
                                    Are you sure you want to delete the <b>"<?= $dados[0]['company_name'] ?>"</b> Company?
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-default" data-dismiss="modal">Cancel</button>
                                    <button type="submit" class="btn btn-primary" name="btn_excluir">Yes</button>
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