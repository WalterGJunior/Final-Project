<?php

if(isset($_GET['ret'])){
    $ret = $_GET['ret'];
}

if (isset($ret)) {

    switch ($ret) {
        case 0:
            echo '<div class="alert alert-warning">
                    Preencher o(s) campo(s) Obrigatório(s);
                </div>';
            break;

        case 1:
            echo '<div class="alert alert-success">
                    Ação realizada com sucesso
                </div>';
            break;
        case -1:
            echo '<div class="alert alert-danger">
                    Ocorreu um erro na Operação. Tente novamente mais tarde!;
                </div>';
            break;
        case -2:
            echo '<div class="alert alert-danger">
                        A senha devera conter no mínimo 6 caracteres;
                    </div>';
            break;
        case -3:
            echo '<div class="alert alert-danger">
                        A senha e o Repetir senha não conferem;
                    </div>';
            break;
            case -4:
                echo '<div class="alert alert-danger">
                          O registro não pode ser excluído pois esta em uso;
                        </div>';
            break;
            case -5:
                echo '<div class="alert alert-danger">
                            E-mail already registered! Please enter a different email address;
                        </div>';
            break;
            case -6:
                echo '<div class="alert alert-danger">
                            User not found;
                        </div>';
            break;        
    }
}
