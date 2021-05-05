<?php

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

                        <h2>Nova Conta</h2>
                        <h5>Cadastre aqui todas as suas Contas Bancárias  </h5>

                    </div>
                </div>
                <!-- /. ROW  -->
                <hr />
                <form action="nova_conta.php" method="POST">
                <div class="form-group">
                    <label>Nome do Banco*:</label>
                    <input class="form-control" placeholder="Digite o nome do banco..." name="banco" id="banco"/>
                </div>
                <div class="form-group">
                    <label>Agência*:</label>
                    <input class="form-control" placeholder="Digite o nome da Agência..." name="agencia" id="agencia"/>
                </div>
                <div class="form-group">
                    <label>Número da Conta*:</label>
                    <input class="form-control" placeholder="Digite o Número da Conta..." name="conta" id="name"/>
                </div>
                <div class="form-group">
                    <label>Saldo*:</label>
                    <input class="form-control" placeholder="Digite o Saldo..." name="saldo" id="saldo"/>
                </div>
                <button type="submit" onclick="return ValidarConta()" class="btn btn-success" name="btn_gravar">Gravar</button>
                </form>
            </div>
            <!-- /. PAGE INNER  -->
        </div>
        <!-- /. PAGE WRAPPER  -->
    </div>
    <!-- /. WRAPPER  -->



</body>

</html>