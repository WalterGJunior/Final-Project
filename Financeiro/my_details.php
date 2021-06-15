<?php

require_once '../DAO/UtilDAO.php';
UtilDAO::VerifySession();

require_once '../DAO/UserDAO.php';

$objDao = new UserDAO();

if (isset($_POST['btn_gravar'])) {
    $nome = $_POST['nome'];
    $email = $_POST['email'];
   

    $ret = $objDao->SaveMyDetails($nome, $email);
}

$data = $objDao->ShowMyDetails();

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

                        <h2>My Details</h2>
                        <h5>On this page you can edit your personal information </h5>
                        
                    </div>
                </div>
                <!-- /. ROW  -->
                <hr />

                <form action="meus_dados.php" method="POST">
                    <div class="form-group">
                        <label>Name</label>
                        <input class="form-control" placeholder="Type your name" name="nome" id="nome" value="<?= $data[0]['user_name']?>"/>
                    </div>
                    <div class="form-group">
                        <label>E-mail</label>
                        <input class="form-control" placeholder="Type your email" name="email" id="email" value="<?= $data[0]['user_email']?>"/>
                    </div>
                    <button type="submit" onclick="return ValidarMeusDados()" class="btn btn-success" name="btn_gravar">Salve</button>
                </form>
            </div>
            <!-- /. PAGE INNER  -->
        </div>
        <!-- /. PAGE WRAPPER  -->
    </div>
    <!-- /. WRAPPER  -->



</body>

</html>