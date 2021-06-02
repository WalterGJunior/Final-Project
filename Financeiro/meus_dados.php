<?php

require_once '../DAO/UtilDAO.php';
UtilDAO::VerifySession();

require_once '../DAO/UsuarioDAO.php';

$objDao = new UsuarioDAO();

if (isset($_POST['btn_gravar'])) {
    $nome = $_POST['nome'];
    $email = $_POST['email'];
   

    $ret = $objDao->GravarMeusDados($nome, $email);
}

$data = $objDao->CarregarMeusDados();

//echo '<pre>';
//print_r($data);
//echo '</pre>';

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

                        <h2>Meus Dados</h2>
                        <h5>Nesta página, você poderá alterar os seus dados </h5>

                    </div>
                </div>
                <!-- /. ROW  -->
                <hr />

                <form action="meus_dados.php" method="POST">
                    <div class="form-group">
                        <label>Nome</label>
                        <input class="form-control" placeholder="Digite o seu nome" name="nome" id="nome" value="<?= $data[0]['user_name']?>"/>
                    </div>
                    <div class="form-group">
                        <label>E-mail</label>
                        <input class="form-control" placeholder="Digite o seu E-mail" name="email" id="email" value="<?= $data[0]['user_email']?>"/>
                    </div>
                    <button type="submit" onclick="return ValidarMeusDados()" class="btn btn-success" name="btn_gravar">Gravar</button>
                </form>
            </div>
            <!-- /. PAGE INNER  -->
        </div>
        <!-- /. PAGE WRAPPER  -->
    </div>
    <!-- /. WRAPPER  -->



</body>

</html>