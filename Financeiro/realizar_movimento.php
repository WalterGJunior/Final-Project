<?php
require_once '../DAO/UtilDAO.php';
UtilDAO::VerifySession();


require_once '../DAO/MovimentoDAO.php';
require_once '../DAO/ContaDAO.php';
require_once '../DAO/EmpresaDAO.php';
require_once '../DAO/CategoriaDAO.php';

$dao_category = new CategoriaDAO();
$dao_company = new EmpresaDAO();
$dao_account = new ContaDAO();

if (isset($_POST['btn_gravar'])) {
    $tipo = $_POST['tipo'];
    $data = $_POST['data'];
    $valor = $_POST['valor'];
    $categoria = $_POST['categoria'];
    $empresa = $_POST['empresa'];
    $conta = $_POST['conta'];
    $obs = $_POST['obs'];

    $objDao = new MovimentoDAO();

    $ret = $objDao->RealizarMovimento($tipo, $data, $valor, $categoria, $empresa, $conta, $obs);
}

$categories = $dao_category ->Consultarcategoria();
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

                        <h2>Realizar Movimento</h2>
                        <h5>Aqui você pode realizar todos movimentos de Entradas e Saídas. </h5>

                    </div>
                </div>
                <!-- /. ROW  -->
                <hr />

                <form action="realizar_movimento.php" method="POST">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Tipo:</label>
                            <select class="form-control" name="tipo" id="tipo">
                                <option value="">Selecione</option>
                                <option value="1">Entrada</option>
                                <option value="2">Saídas</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Data*</label>
                            <input type="date" name="data" class="form-control" placeholder="Coloque a data do movimento" id="data"/>
                        </div>
                        <div class="form-group">
                            <label>Valor:</label>
                            <input class="form-control" name="valor" placeholder="Digite o valor do movimento" id="valor"/>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="form-group">
                            <label>Categoria:</label>
                            <select class="form-control" name="categoria" id="data">
                                <option value="">Selecione</option>
                                <?php foreach($categories as $item){?>
                                    <option value="<?= $item['id_category']?>">
                                        <?= $item['category_name']?>
                                    </option>
                                <?php }?>
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Empresa:</label>
                            <select class="form-control" name="empresa" id="empresa">
                                <option value="">Selecione</option>
                                <?php foreach($companies as $item){?>
                                    <option value="<?= $item['id_company']?>">
                                        <?= $item['company_name']?>
                                    </option>
                                <?php }?>
                            </select>
                        </div>
                        <div class="form-group">
                            <label>Conta:</label>
                            <select class="form-control" name="conta" id="conta">
                                <option value="">Selecione</option>
                                <?php foreach($accounts as $item){?>
                                    <option value="<?= $item['id_account']?>">
                                        <?= 'Bank Name: ' . $item['bank_name'] . ', Branch Number: ' . $item['branch_number'] . ' / ' . $item['account_number'] . ', Available Founds: ' . $item['available_founds']?>
                                    </option>
                                <?php }?>
                            </select>
                        </div>
                    </div>

                    <div class="col-md-12">
                        <div class="form-group">
                            <label>Observação(Opcional)</label>
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