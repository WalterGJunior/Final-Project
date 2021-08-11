<?php

require_once '../DAO/UserDAO.php';

if (isset($_POST['btn_finalizar'])) {
    $nome = $_POST['nome'];
    $email = $_POST['email'];
    $senha = $_POST['senha'];
    $rsenha = $_POST['rsenha'];

    if (trim($senha) != trim($rsenha)) {
        return -3;

    } else if (strlen($senha) < 6) {
        return -2;

    } else {

        $password_hash = password_hash($senha, PASSWORD_DEFAULT);

        $objDao = new UserDAO();

        $ret = $objDao->CreateNewUser($nome, $email, $password_hash);
     
        
    }
}

?>

<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">
<?php
include_once '_head.php';
?>

<body>
    <div class="container">
        <div class="row text-center  ">
            <div class="col-md-12">
                <br />
                <?php include_once '_msg.php'; ?>

                <br />
                <h2> Financial Control : Register</h2>

                <h5>( Sign up )</h5>
                <br />
            </div>
        </div>
        <div class="row">

            <div class="col-md-4 col-md-offset-4 col-sm-6 col-sm-offset-3 col-xs-10 col-xs-offset-1">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <strong> * Indicates Required Field </strong>
                    </div>
                    <div class="panel-body">
                        <form action="register.php" method="post">
                            <br />
                            <div class="form-group input-group">
                                <span class="input-group-addon"><i class="fa fa-circle-o-notch"></i></span>
                                <input type="text" class="form-control" placeholder="* Your Name" name="nome" />
                            </div>
                            <div class="form-group input-group">
                                <span class="input-group-addon">@</span>
                                <input type="text" class="form-control" placeholder="* Your Email" name="email" />
                            </div>
                            <div class="form-group input-group">
                                <span class="input-group-addon"><i class="fa fa-lock"></i></span>
                                <input type="password" class="form-control" placeholder="* Enter Password" name="senha" />
                            </div>
                            <div class="form-group input-group">
                                <span class="input-group-addon"><i class="fa fa-lock"></i></span>
                                <input type="password" class="form-control" placeholder="* Retype Password" name="rsenha" />
                            </div>

                            <button class="btn btn-success " name="btn_finalizar">Complete</button>
                            <hr />
                            Already Registered ? <a href="login.php">Login here</a>
                        </form>
                    </div>

                </div>
            </div>


        </div>
    </div>

</body>

</html>