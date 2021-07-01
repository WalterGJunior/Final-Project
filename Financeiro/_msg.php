<?php

if(isset($_GET['ret'])){
    $ret = $_GET['ret'];
}

if (isset($ret)) {

    switch ($ret) {
        case 0:
            echo '<div class="alert alert-warning">
                    Warning! Please, complete all the required fields;
                </div>';
            break;

        case 1:
            echo '<div class="alert alert-success">
                    Action realized successfully
                </div>';
            break;
        case -1:
            echo '<div class="alert alert-danger">
                    An Error occurred in this operation. Please, try again later!;
                </div>';
            break;
        case -2:
            echo '<div class="alert alert-danger">
                        Password must have minimum 6 characters;
                    </div>';
            break;
        case -3:
            echo '<div class="alert alert-danger">
                        Password must match the previous entry;                       
                    </div>';
            break;
            case -4:
                echo '<div class="alert alert-danger">
                        The register cannot be deleted, once it is already used;
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
