<?php


require_once '../DAO/UtilDAO.php';

if(isset($_GET['close']) && $_GET['close']==1){
    UtilDAO::disconnect();
}

?>

<nav class="navbar-default navbar-side" role="navigation">
    <div class="sidebar-collapse">
        <ul class="nav" id="main-menu">
            <li>
                <a href="dashboard.php"><i class="fa fa-dashboard fa-3x"></i>Dashboard</a>
            </li>

            <li>
                <a href="meus_dados.php"><i class="fa fa-user fa-3x"></i> My Details</a>
            </li>

            <!-- CATEGORIA -->
            <li>
                <a href="#"><i class="fa fa-sitemap fa-3x"></i> Category<span class="fa arrow"></span></a>
                <ul class="nav nav-second-level">
                    <li>
                        <a href="nova_categoria.php">Create a new category</a>
                    </li>
                    <li>
                        <a href="consultar_categoria.php">Search / Change</a>
                    </li>
                </ul>
            </li>
            <!-- EMPRESA -->
            <li>
                <a href="#"><i class="fa fa-building fa-3x"></i>Company<span class="fa arrow"></span></a>
                <ul class="nav nav-second-level">
                    <li>
                        <a href="nova_empresa.php">Create a new company</a>
                    </li>
                    <li>
                        <a href="consultar_empresa.php">Search / Change</a>
                    </li>
                </ul>
            </li>
            <!-- CONTA -->
            <li>
                <a href="#"><i class="fa fa-bar-chart-o fa-3x"></i>Bank Account<span class="fa arrow"></span></a>
                <ul class="nav nav-second-level">
                    <li>
                        <a href="nova_conta.php">Create a new account</a>
                    </li>
                    <li>
                        <a href="consultar_conta.php">Search / Change</a>
                    </li>
                </ul>
            </li>
            <!-- MOVIMENTO -->
            <li>
                <a href="#"><i class="fa fa-signal fa-3x"></i> Transactions<span class="fa arrow"></span></a>
                <ul class="nav nav-second-level">
                    <li>
                        <a href="realizar_movimento.php">Make a new transaction</a>
                    </li>
                    <li>
                        <a href="consultar_movimento.php">Search for a transaction</a>
                    </li>
                </ul>
            </li>

            <li>
                <a class="active-menu" href="_navbar.php?close=1">Sign out</a>
            </li>
        </ul>

    </div>

</nav>