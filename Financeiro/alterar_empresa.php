<?php

require_once '../DAO/EmpresaDAO.php';

if (isset($_POST['btn_salvar'])) {
    $empresa = $_POST['empresa'];
    $telefone = $_POST['telefone'];
    $endereco = $_POST['endereco'];

    $objDao = new EmpresaDAO();

    $ret = $objDao->AlterarEmpresa($empresa, $telefone, $endereco);
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
                    <div class="form-group">
                        <label>Nome da empresa*:</label>
                        <input class="form-control" placeholder="Digite aqui..." name="empresa" id="nomeempresa"/>
                    </div>
                    <div class="form-group">
                        <label>Telefone:</label>
                        <input class="form-control" placeholder="Digite aqui..." name="telefone" />
                    </div>
                    <div class="form-group">
                        <label>Endereço:</label>
                        <input class="form-control" placeholder="Digite aqui..." name="endereco" />
                    </div>
                    <button type="submit" onclick="return ValidarEmpresa()" class="btn btn-success" name="btn_salvar">Salvar</button>
                    <button type="submit" class="btn btn-danger " name="btn_excluir">Excluir</button>
                </form>
            </div>
            <!-- /. PAGE INNER  -->
        </div>
        <!-- /. PAGE WRAPPER  -->
    </div>
    <!-- /. WRAPPER  -->



</body>

</html>