<?php

require_once '../DAO/UserDAO.php';

if (isset($_POST['btn_acessar'])) {
    $email = $_POST['email'];
    $senha = $_POST['senha'];

    $objDao = new UserDAO();

    $ret = $objDao->ValidarLogin($email, $senha);
}

?>


<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">

<?php
    include_once '_head.php';
?>

<body>
    <div class="container">
        <div class="row text-center ">
            <div class="col-md-12">

            <?php include_once '_msg.php'; ?>

                <br />  
                <h2 > Financial Control : Login </h2>

                <h5> Here you can access the application </h5>
                <br />
            </div>
        </div>
        <div class="row ">

            <div class="col-md-4 col-md-offset-4 col-sm-6 col-sm-offset-3 col-xs-10 col-xs-offset-1">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <strong > Please, enter with your Username and Password  </strong>
                    </div>
                    <div class="panel-body">
                        <form action="login.php" method="POST">
                            <br />
                            <div class="form-group input-group">
                                <span class="input-group-addon"><i class="fa fa-tag"></i></span>
                                <input type="text" class="form-control" placeholder="Your Username " name="email"/>
                            </div>
                            <div class="form-group input-group">
                                <span class="input-group-addon"><i class="fa fa-lock"></i></span>
                                <input type="password" class="form-control" placeholder="Your Password" name="senha"/>
                            </div>
                           
                            <button class="btn btn-primary " name="btn_acessar">Login</button>
                            <hr />
                            If you still have no access: <a href="register.php">Sign up </a>
                        </form>
                    </div>

                </div>
            </div>


        </div>
    </div>




</body>

</html>