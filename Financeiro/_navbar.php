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
                <a href="my_details.php"><i class="fa fa-user fa-3x"></i> My Details</a>
            </li>

            <!-- CATEGORY -->
            <li>
                <a href="#"><i class="fa fa-sitemap fa-3x"></i> Category<span class="fa arrow"></span></a>
                <ul class="nav nav-second-level">
                    <li>
                        <a href="new_category.php">Create a new category</a>
                    </li>
                    <li>
                        <a href="search_category.php">Search / Change</a>
                    </li>
                </ul>
            </li>
            <!-- COMPANY -->
            <li>
                <a href="#"><i class="fa fa-building fa-3x"></i>Company<span class="fa arrow"></span></a>
                <ul class="nav nav-second-level">
                    <li>
                        <a href="new_company.php">Create a new company</a>
                    </li>
                    <li>
                        <a href="search_company.php">Search / Change</a>
                    </li>
                </ul>
            </li>
            <!-- BANK ACCOUNT -->
            <li>
                <a href="#"><i class="fa fa-bar-chart-o fa-3x"></i>Bank Account<span class="fa arrow"></span></a>
                <ul class="nav nav-second-level">
                    <li>
                        <a href="new_account.php">Create a new account</a>
                    </li>
                    <li>
                        <a href="search_account.php">Search / Change</a>
                    </li>
                </ul>
            </li>
            <!-- TRANSACTION -->
            <li>
                <a href="#"><i class="fa fa-signal fa-3x"></i> Transactions<span class="fa arrow"></span></a>
                <ul class="nav nav-second-level">
                    <li>
                        <a href="new_transaction.php">Make a new transaction</a>
                    </li>
                    <li>
                        <a href="search_transaction.php">Search for a transaction</a>
                    </li>
                </ul>
            </li>

            <li>
                <a class="active-menu" href="_navbar.php?close=1">Sign out</a>
            </li>
        </ul>

    </div>

</nav>