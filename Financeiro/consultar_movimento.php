<?php

require_once '../DAO/MovimentoDAO.php';

if (isset($_POST['btn_salvar'])) {
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
                        <h2>Consultar Movimento</h2>
                        <h5>Consulte todos as movimentos em um determinado período </h5>

                    </div>
                </div>
                <!-- /. ROW  -->
                <hr />


                <div class="col-md-12">
                    <div class="form-group">
                        <label>Tipo do Movimento:</label>
                        <select class="form-control">
                            <option value="0">TODOS</option>
                            <option value="1">Entrada</option>
                            <option value="2">Saídas</option>
                        </select>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label>Data Inicial*</label>
                        <input type="date" class="form-control" placeholder="Coloque a data do movimento" id="dataInicial"/>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label>Data Final*</label>
                        <input type="date" class="form-control" placeholder="Coloque a data do movimento" id="dataFinal"/>
                    </div>
                </div>

                <center>
                    <button class="btn btn-info" onclick="return ValidarConsultarMovimento()">Pesquisar</button>
                </center>
                <hr />
                
                <div class="row">
                    <div class="col-md-12">
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                Resultados Encontrados
                            </div>
                            <div class="panel-body">
                                <div class="table-responsive">
                                    <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                                        <thead>
                                            <tr>
                                                <th>Data</th>
                                                <th>Tipo</th>
                                                <th>Categoria</th>
                                                <th>Empresa</th>
                                                <th>Conta</th>
                                                <th>Valor</th>
                                                <th>Observação</th>
                                                <th>Ação</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr class="odd gradeX">
                                                <td>(data)</td>
                                                <td>(tipo)</td>
                                                <td>(categoria)</td>
                                                <td>(empresa)</td>
                                                <td>(conta)</td>
                                                <td>(valor)</td>
                                                <td>(obs)</td>
                                                <td>
                                                    <a href="#" class="btn btn-danger btn-sm">Excluir</a>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>

                            </div>
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