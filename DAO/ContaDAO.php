<?php

require_once 'Conexao.php';
require_once 'UtilDAO.php';

class ContaDAO extends Conexao{

    public function CadastrarConta($banco, $agencia, $conta, $saldo){

        if(trim($banco) == '' || trim($agencia) == '' || trim($conta) == '' || trim($saldo) == ''){
            return 0;
        }

        //Step 1: Creting the variable that will recieve the object to the connection with the DB 
        $connection = parent::retornarConexao();

        //Step 2: variable that will receive the SQL command to insert the information in the database
        $sql_command = 'insert into tb_account 
        (bank_name, branch_number, account_number, available_founds, fk_id_user)
        values
        (?,?,?,?,?);';
        
        //Step 3: Creating a object to send the information to the database
        $sql = new PDOStatement();

        //Step 4: To put inside the object $sql the connection prepared to execute the SQL command 
        $sql = $connection->prepare($sql_command); 

        //Step 5: Verify if the SQL command that I have to be settled up. If there re BindValues
        $sql->bindValue(1, $banco);
        $sql->bindValue(2, $agencia);
        $sql->bindValue(3, $conta);
        $sql->bindValue(4, $saldo);
        $sql->bindValue(5, UtilDAO::CodigoLogado());

        try {

            //Step 6:  Execute in the database 
            $sql->execute();

            return 1;

        } catch (Exception $ex) {
            echo $ex->getMessage(); 
            return -1;
        }

    }

    public function AlterarConta($banco, $agencia, $conta, $saldo){

        if(trim($banco) == '' || trim($agencia) == '' || trim($conta) == '' || trim($saldo) == ''){
            return 0;
        }

    }


}
