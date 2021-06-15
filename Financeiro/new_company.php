<?php
require_once '../DAO/UtilDAO.php';
UtilDAO::VerifySession();

require_once '../DAO/CompanyDAO.php';

if (isset($_POST['btn_gravar'])) {
    $empresa = $_POST['empresa'];
    $telefone = $_POST['telefone'];
    $endereco = $_POST['endereco'];

    $objDao = new CompanyDAO();

    $ret = $objDao->CreateCompany($empresa, $telefone, $endereco);
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

                        <h2>New company</h2>
                        <h5>Here you can register a new company to be used in your transactions </h5>

                    </div>
                </div>
                <!-- /. ROW  -->
                <hr />
                <form action="nova_empresa.php" method="POST">
                    <div class="form-group">
                        <label>Company Name*:</label>
                        <input class="form-control" placeholder="Type here..." name="empresa" id="nomeempresa"/>
                    </div>
                    <div class="form-group">
                        <label>Phone:</label>
                        <input class="form-control" placeholder="Type here..." name="telefone" />
                    </div>
                    <div class="form-group">
                        <label>Address:</label>
                        <input class="form-control" placeholder="Type here..." name="endereco" />
                    </div>
                    <button type="submit" onclick="return ValidarEmpresa()" class="btn btn-success" name="btn_gravar">Salve</button>
                </form>
            </div>
            <!-- /. PAGE INNER  -->
        </div>
        <!-- /. PAGE WRAPPER  -->
    </div>
    <!-- /. WRAPPER  -->



</body>

</html>