<?php

require_once 'Connection.php';
require_once 'UtilDAO.php';

class UserDAO extends Connection
{

    public function ShowMyDetails()
    {

        //Step 1: Creting the variable that will recieve the object to the connection with the DB 
        $connection = parent::returnConnection();

        //Step 2: variable that will receive the SQL command to insert the information in the database
        $sql_command = 'select user_name, 
                               user_email
                         from tb_user
                         where id_user = ?';

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

    public function SaveMyDetails($name, $email)
    {

        if (trim($name) == '' || trim($email) == '') {
            return 0;
        }

        //Step 1: Creting the variable that will recieve the object to the connection with the DB 
        $connection = parent::returnConnection();

        //Step 2: variable that will receive the SQL command to insert the information in the database
        $sql_command = 'update tb_user
                            set user_name = ?,
                            user_email = ?
                        where id_user = ?';

        //Step 3: Creating a object to send the information to the database
        $sql = new PDOStatement();

        //Step 4: To put inside the object $sql the connection prepared to execute the SQL command 
        $sql = $connection->prepare($sql_command);

        //Step 5: Verify if the SQL command that I have to be settled up. If there re BindValues
        $sql->bindValue(1, $name);
        $sql->bindValue(2, $email);
        $sql->bindValue(3, UtilDAO::UserLoggedIn());

        try {

            //Step 6:  Execute in the database 
            $sql->execute();

            return 1;
        } catch (Exception $ex) {
            echo $ex->getMessage();
            return -1;
        }
    }

    public function ValidateLogin($email, $senha)
    {
        if (trim($email) == '' || trim($senha) == '') {
            return 0;
        }

        $connection = parent::returnConnection();
        $sql_command = 'select id_user, user_name, user_password from tb_user
                        where user_email = ?';

        $sql = new PDOStatement();
        $sql = $connection->prepare($sql_command);

        $sql->bindValue(1, $email);

        $sql->setFetchMode(PDO::FETCH_ASSOC);

        $sql->execute();
        $user = $sql->fetchAll();

        if (count($user) == 0) {
           return -6;
        }

        if(password_verify($senha, $user[0]['user_password'])){
            $cod = $user[0]['id_user'];
            $name = $user[0]['user_name'];
            UtilDAO::CreateSession($cod, $name);
    
            header('location: my_details.php');
            exit;
        }else{
            return -1;
        }


        
    }

    public function CheckDuplicatedEmails($email)
    {
        if (trim($email) == '') {
            return 0;
        }

        $connection = parent::returnConnection();

        $sql_command = 'select coun(user_email) as result from tb_user where user_email = ?';

        $sql = new PDOStatement();
        $sql = $connection->prepare($sql_command);

        $sql->bindValue(1, $email);

        $sql->setFetchMode(PDO::FETCH_ASSOC);

        $sql->execute();

        $result = $sql->fetchAll();

        return $result[0]['result'];
    }

    public function CheckDuplicatedEmailsChanges($email)
    {
        if (trim($email) == '') {
            return 0;
        }

        $connection = parent::returnConnection();

        $sql_command = 'select coun(user_email) as result 
                        from tb_user where user_email = ? and id_user != ?';

        $sql = new PDOStatement();
        $sql = $connection->prepare($sql_command);

        $sql->bindValue(1, $email);
        $sql->bindValue(2, UtilDAO::UserLoggedIn());
        
        
            
            $sql->setFetchMode(PDO::FETCH_ASSOC);
            
            $sql->execute();

            $result = $sql->fetchAll();

            return $result[0]['result'];

        
    }

    public function CreateNewUser($nome, $email, $password_hash)
    {
        if (trim($nome) == '' || trim($email) == '' || trim($password_hash) == '') {
            return 0;
        }

        //if(strlen($senha) < 6){
        //  return -2;
        //} 

        //if(trim($senha) != trim($rsenha)){
        // return -3;
        //} 

        //if ($this->CheckDuplicatedEmailsChanges($email) != 0) {
            //return -5;
        //}
       
        
        $connection = parent::returnConnection();

        $sql_command = 'insert into tb_user(user_name, user_email, user_password, registration_date)
                            values (?,?,?,?)';

        $sql = new PDOStatement();
        $sql = $connection->prepare($sql_command);

        $sql->bindValue(1, $nome); 
        $sql->bindValue(2, $email);
        $sql->bindValue(3, $password_hash); 
        $sql->bindValue(4, date('Y-m-d'));

        try {
            $sql->execute();
            return 1;

        } catch (Exception $ex) {
            echo $ex->getMessage();
            return -1;
        }
    }
}
