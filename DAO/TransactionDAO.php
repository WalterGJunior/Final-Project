<?php
require_once 'Connection.php';
require_once 'UtilDAO.php';

class TransactionDAO extends Connection{

    public function CreateTransaction($tipo, $data, $valor, $categoria, $empresa, $conta, $obs){

        if($tipo == '' || trim($data) == '' || trim($valor) == '' || $categoria == '' || $empresa == '' || $conta == '' ){
            return 0;   
        }

        //Step 1: Creating the variable that will recieve the object to the connection with the DB 
        $connection = parent::returnConnection();

        //Step 2: variable that will receive the SQL command to insert the information in the database
        $sql_command = 'insert into tb_transactions
                        (transaction_type, transactions_date, transactions_amount, transaction_comments, 
                        fk_id_company, fk_id_account, fk_id_category, fk_id_user)
                        values (?, ?, ?, ?, ?, ?, ?, ?)';
        
        //Step 3: Creating a object to send the information to the database
        $sql = new PDOStatement();

        //Step 4: To put inside the object $sql the connection prepared to execute the SQL command 
        $sql = $connection->prepare($sql_command); 

        //Step 5: Verify if the SQL command that I have to be settled up. If there re BindValues
        $sql->bindValue(1, $tipo);
        $sql->bindValue(2, $data);
        $sql->bindValue(3, $valor);
        $sql->bindValue(4, $obs);
        $sql->bindValue(5, $categoria);
        $sql->bindValue(6, $empresa);
        $sql->bindValue(7, $conta);
        $sql->bindValue(8, UtilDAO::UserLoggedIn());

        $connection->beginTransaction();

        try {

            //Step 6:  Execute the insert on the database 
            $sql->execute();

            if($tipo == 1){
                $sql_command = 'update tb_account 
                                    set available_funds = available_funds + ?
                                where id_account = ?';
            }else if($tipo == 2){
                $sql_command = 'update tb_account 
                                    set available_funds = available_funds - ?
                                where id_account = ?';
            }

            $sql = $connection->prepare($sql_command); 
            
            $sql->bindValue(1, $valor);
            $sql->bindValue(2, $conta);

            //Step 6:  Execute the update of the amount on the database
            $sql -> execute();

            $connection->commit();

            return 1;

        } catch (Exception $ex) {
            //echo $ex->getMessage(); 
            $connection->rollBack();
            return -1;
        }

    }

    public function DeleteTransaction($id_transaction, $id_account, $amount, $type){

        if($id_transaction == '' || $id_account == '' || $amount == '' || $type == ''){
            return 0;
        }

        //Step 1: Creting the variable that will recieve the object to the connection with the DB 
        $connection = parent::returnConnection();

        //Step 2: variable that will receive the SQL command to insert the information in the database
        $sql_command = 'delete 
                        from tb_transactions  
                        where id_transactions = ?';

        //Step 3: Creating a object to send the information to the database
        $sql = new PDOStatement();

        //Step 4: To put inside the object $sql the connection prepared to execute the SQL command 
        $sql = $connection->prepare($sql_command); 

        //Step 5: Verify if the SQL command that I have to be settled up. If there re BindValues
        $sql->bindValue(1, $id_transaction);

        $connection->beginTransaction();

        try {

            //Step 6:  Execute in the database 
            $sql->execute();

            if($type == 1){
                $sql_command = 'update tb_account 
                                    set available_funds = available_funds - ?
                                where id_account = ?';
            }else if($type == 2){
                
                $sql_command = 'update tb_account 
                                    set available_funds = available_funds + ?
                                where id_account = ?';
            }

            $sql = $connection->prepare($sql_command); 

            $sql->bindValue(1, $amount);
            $sql->bindValue(2, $id_account);
            
            //Update the amount
            $sql->execute();

            $connection->commit();

            return 1;

        } catch (Exception $ex) {
            $connection->rollBack();
            //echo $ex->getMessage(); 
            return -1;
        }


    } 

    public function SearchTransaction($type, $initial_date, $final_date){
        if(trim($initial_date) == '' || trim($final_date) == ''){
            return 0;
        }

        //Step 1: Creting the variable that will recieve the object to the connection with the DB 
        $connection = parent::returnConnection();

        //Step 2: variable that will receive the SQL command to insert the information in the database
        $sql_command = 'select id_transactions,
                               tb_transactions.fk_id_account, 
                               transaction_type, 
                               transactions_date,
                               transactions_amount,
                               category_name,
                               company_name,
                               bank_name,
                               account_number,
                               bic_number,
                               transaction_comments
                        from tb_transactions
                        inner join tb_category
                            on tb_category.id_category = tb_transactions.fk_id_category
                        inner join tb_company
                            on tb_company.id_company = tb_transactions.fk_id_company
                        inner join tb_account
                            on tb_account.id_account = tb_transactions.fk_id_account    
                        where tb_transactions.fk_id_user = ?
                              and tb_transactions.transactions_date between ? and ?';

                        if ($type != 0){
                            $sql_command = $sql_command . ' and transaction_type = ?';
                        }
        
        //Step 3: Creating a object to send the information to the database
        $sql = new PDOStatement();

        //Step 4: To put inside the object $sql the connection prepared to execute the SQL command 
        $sql = $connection->prepare($sql_command); 

        //Step 5: Verify if the SQL command that I have to be settled up. If there re BindValues
        $sql->bindValue(1, UtilDAO::UserLoggedIn());
        $sql->bindValue(2, $initial_date);
        $sql->bindValue(3, $final_date);

        if($type != 0){
            $sql->bindValue(4, $type);            
        }

        //Step 7: Remove the Index from the Array. 
        //return each row as an array indexed by column name 
        //as returned in the corresponding result set.
        $sql->setFetchMode(PDO::FETCH_ASSOC);

        //Step 6:  Execute in the database 
        $sql->execute();

        return  $sql->fetchAll();


    }

    public function ShowLatestTransactions(){

        //Step 1: Creting the variable that will recieve the object to the connection with the DB 
        $connection = parent::returnConnection();

        //Step 2: variable that will receive the SQL command to insert the information in the database
        $sql_command = 'select id_transactions,
                               tb_transactions.fk_id_account, 
                               transaction_type, 
                               transactions_date,
                               transactions_amount,
                               category_name,
                               company_name,
                               bank_name,
                               account_number,
                               bic_number,
                               transaction_comments
                        from tb_transactions
                        inner join tb_category
                            on tb_category.id_category = tb_transactions.fk_id_category
                        inner join tb_company
                            on tb_company.id_company = tb_transactions.fk_id_company
                        inner join tb_account
                            on tb_account.id_account = tb_transactions.fk_id_account    
                        where tb_transactions.fk_id_user = ?
                            order by tb_transactions.id_transactions DESC limit 10';

                       
        
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

    public function TotalEarnings(){

        $connection = parent::returnConnection();
        $sql_command = 'select sum(transactions_amount) as total
                            from tb_transactions
                        where transaction_type = 1
                            and fk_id_user = ?';

        $sql = new PDOStatement();

        $sql = $connection->prepare($sql_command);

        $sql->bindValue(1, UtilDAO::UserLoggedIn());
        $sql->setFetchMode(PDO::FETCH_ASSOC);

        $sql->execute();

        return $sql->fetchAll();
    }

    public function TotalExpenses(){
        $connection = parent::returnConnection();

        $sql_command = 'select sum(transactions_amount) as total
                        from tb_transactions
                        where transaction_type = 2
                        and fk_id_user = ?';

        $sql = new PDOStatement();

        $sql = $connection->prepare($sql_command);

        $sql->bindValue(1, UtilDAO::UserLoggedIn());
        $sql->setFetchMode(PDO::FETCH_ASSOC);

        $sql->execute();

        return $sql->fetchAll();
    }

}