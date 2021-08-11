<?php

require_once 'Connection.php';
require_once 'UtilDAO.php';

class AccountDAO extends Connection{

    public function CreateAccount($banco, $bic, $conta, $saldo){

        if(trim($banco) == '' || trim($bic) == '' || trim($conta) == '' || trim($saldo) == ''){
            return 0;
        }

        //Step 1: Creting the variable that will recieve the object to the connection with the DB 
        $connection = parent::returnConnection();

        //Step 2: variable that will receive the SQL command to insert the information in the database
        $sql_command = 'insert into tb_account 
        (bank_name, account_number, bic_number, available_funds, id_user)
        values
        (?,?,?,?,?);';
        
        //Step 3: Creating a object to send the information to the database
        $sql = new PDOStatement();

        //Step 4: To put inside the object $sql the connection prepared to execute the SQL command 
        $sql = $connection->prepare($sql_command); 

        //Step 5: Verify if the SQL command that I have to be settled up. If there re BindValues
        $sql->bindValue(1, $banco);
        $sql->bindValue(2, $bic);
        $sql->bindValue(3, $conta);
        $sql->bindValue(4, $saldo);
        $sql->bindValue(5, UtilDAO::UserLoggedIn());

        try {

            //Step 6:  Execute in the database 
            $sql->execute();

            return 1;

        } catch (Exception $ex) {
            echo $ex->getMessage(); 
            return -1;
        }

    }

    public function SearchAccount(){
        //Step 1: Creting the variable that will recieve the object to the connection with the DB 
        $connection = parent::returnConnection();

        //Step 2: variable that will receive the SQL command to insert the information in the database
        $sql_command = 'select id_account, 
                            bank_name,
                            bic_number,
                            account_number,
                            available_funds
                        from tb_account
                        where id_user = ? order by bank_name ASC';
        
        //Step 3: Creating a object to send the information to the database
        $sql = new PDOStatement();

        //Step 4: To put inside the object $sql the connection prepared to execute the SQL command 
        $sql = $connection->prepare($sql_command); 

        //Step 5: Verify if the SQL command that I have to be settled up. If there re BindValues
        $sql->bindValue(1, UtilDAO::UserLoggedIn());

        //Step 7: Remove the Index from the Array. 
        //return each row as an array indexed by column name 
        //as returned in the corresponding result set.
        $sql->setFetchMode(PDO::FETCH_ASSOC);

        //Step 6:  Execute in the database 
        $sql->execute();

        return  $sql->fetchAll();
    }

    public function AccountDetail($idAccount){

        //Step 1: Creting the variable that will recieve the object to the connection with the DB 
        $connection = parent::returnConnection();

        //Step 2: variable that will receive the SQL command to insert the information in the database
        $sql_command = 'select id_account, 
                            bank_name,
                            bic_number,
                            account_number,
                            available_funds
                        from tb_account
                        where id_account =?
                        and id_user = ?';

        //Step 3: Creating a object to send the information to the database
        $sql = new PDOStatement();

        //Step 4: To put inside the object $sql the connection prepared to execute the SQL command 
        $sql = $connection->prepare($sql_command); 

        //Step 5: Verify if the SQL command that I have to be settled up. If there re BindValues
        $sql->bindValue(1, $idAccount);
        $sql->bindValue(2, UtilDAO::UserLoggedIn());

        //Step 7: Remove the Index from the Array. 
        //return each row as an array indexed by column name 
        //as returned in the corresponding result set.
        $sql->setFetchMode(PDO::FETCH_ASSOC);

        //Step 6:  Execute in the database 
        $sql->execute();

        return  $sql->fetchAll();
    }

    public function AlterAccount($idAccount, $banco, $bic, $conta, $saldo){

        if(trim($banco) == '' || trim($bic) == '' || trim($conta) == '' || trim($saldo) == ''){
            return 0;
        }

        //Step 1: Creting the variable that will recieve the object to the connection with the DB 
        $connection = parent::returnConnection();

        //Step 2: variable that will receive the SQL command to insert the information in the database
        $sql_command = 'update tb_account  
                        set  bank_name = ?,
                            bic_number =?, 
                            account_number =?,                                               
                            available_funds =?
                        where id_account = ?
                            and id_user = ?';

        //Step 3: Creating a object to send the information to the database
        $sql = new PDOStatement();

        //Step 4: To put inside the object $sql the connection prepared to execute the SQL command 
        $sql = $connection->prepare($sql_command); 

        //Step 5: Verify if the SQL command that I have to be settled up. If there re BindValues
        $sql->bindValue(1, $banco);
        $sql->bindValue(2, $bic);
        $sql->bindValue(3, $conta);
        $sql->bindValue(4, $saldo);
        $sql->bindValue(5, $idAccount);
        $sql->bindValue(6, UtilDAO::UserLoggedIn());
         
        try {

            //Step 6:  Execute in the database 
            $sql->execute();

            return 1;

        } catch (Exception $ex) {
            echo $ex->getMessage(); 
            return -1;
            
        }
        
        return  $sql->fetchAll();
    }

    public function DeleteAccount($idAccount){
        if($idAccount == ''){            
            return 0;
        }

        //Step 1: Creting the variable that will recieve the object to the connection with the DB 
        $connection = parent::returnConnection();

        //Step 2: variable that will receive the SQL command to insert the information in the database
        $sql_command = 'delete 
                        from tb_account  
                        where id_account = ?
                           and id_user = ?';

        //Step 3: Creating a object to send the information to the database
        $sql = new PDOStatement();

        //Step 4: To put inside the object $sql the connection prepared to execute the SQL command 
        $sql = $connection->prepare($sql_command); 

        //Step 5: Verify if the SQL command that I have to be settled up. If there re BindValues
        $sql->bindValue(1, $idAccount);
        $sql->bindValue(2, UtilDAO::UserLoggedIn());

        try {

            //Step 6:  Execute in the database 
            $sql->execute();

            return 1;

        } catch (Exception $ex) {
            //echo $ex->getMessage(); 
            return -4;
        }

        return  $sql->fetchAll();
    }
  


}
