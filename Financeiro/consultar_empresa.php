<?php
require_once '../DAO/UtilDAO.php';
UtilDAO::VerifySession();

require_once '../DAO/CompanyDAO.php';

$objDao = new CompanyDAO();
$companies = $objDao->SearchCompany();

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
                        <?php include_once '_msg.php'?>
                        <h2>Search for your Companies</h2>
                        <h5>Here you can find all registered Companies </h5>

                    </div>
                </div>
                <!-- /. ROW  -->
                <hr />

                <div class="panel panel-default">
                        <div class="panel-heading">
                        List of all registered companies. In case you want to change any, click on the button. 
                        </div>
                        <div class="panel-body">
                            <div class="table-responsive">
                                <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                                    <thead>
                                        <tr>
                                            <th>Company Name</th>
                                            <th>Phone</th>
                                            <th>Address</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>

                                    <?php for($i = 0; $i<count($companies);$i++) { ?>

                                        <tr class="odd gradeX">
                                            <td><?= $companies[$i]['company_name']?></td>
                                            <td><?= $companies[$i]['telephone_number']?></td>
                                            <td><?= $companies[$i]['company_address']?></td>
                                            <td>
                                                <a href="alterar_empresa.php?cod=<?=$companies[$i]['id_company']?>" class="btn btn-warning btn-sm">Change</a>
                                            </td>
                                        </tr> 
                                    <?php }?>                                       
                                    </tbody>
                                </table>
                            </div>
                            
                        </div>
                    </div>

            </div>
            <!-- /. PAGE INNER  -->
        </div>
        <!-- /. PAGE WRAPPER  -->
    </div>
    <!-- /. WRAPPER  -->



</body>

</html>