<?php

require_once 'Connection.php';
require_once 'UtilDAO.php';

class CategoryDAO extends Connection{

    public function CreateCategory($nome){

        if(trim($nome) == ''){            
            return 0;
        }
        //Step 1: Creating the variable that will recieve the object to the connection with the DB 
        $connection = parent::returnConnection();

        //Step 2: variable that will receive the SQL command to insert the information in the database
        $sql_command = 'insert into tb_category
                        (category_name, fk_id_user)
                        values (?, ?);';
        
        //Step 3: Creating a object to send the information to the database
        $sql = new PDOStatement();

        //Step 4: To put inside the object $sql the connection prepared to execute the SQL command 
        $sql = $connection->prepare($sql_command); 

        //Step 5: Verify if the SQL command that I have to be settled up. If there re BindValues
        $sql->bindValue(1, $nome);
        $sql->bindValue(2, UtilDAO::UserLoggedIn());

        try {

            //Step 6:  Execute in the database 
            $sql->execute();

            return 1;

        } catch (Exception $ex) {
            //echo $ex->getMessage(); 
            return -1;
        }
    }

    public function ChangeCategory($nome, $idCategoria){
        if(trim($nome) == '' || $idCategoria == ''){            
            return 0;
        }

        //Step 1: Creting the variable that will recieve the object to the connection with the DB 
        $connection = parent::returnConnection();

        //Step 2: variable that will receive the SQL command to insert the information in the database
        $sql_command = 'update tb_category  
                        set category_name = ?
                        where id_category = ?
                           and fk_id_user = ?';

        //Step 3: Creating a object to send the information to the database
        $sql = new PDOStatement();

        //Step 4: To put inside the object $sql the connection prepared to execute the SQL command 
        $sql = $connection->prepare($sql_command); 

        //Step 5: Verify if the SQL command that I have to be settled up. If there re BindValues
        $sql->bindValue(1, $nome);
        $sql->bindValue(2, $idCategoria);
        $sql->bindValue(3, UtilDAO::UserLoggedIn());

        try {

            //Step 6:  Execute in the database 
            $sql->execute();

            return 1;

        } catch (Exception $ex) {
            //echo $ex->getMessage(); 
            return -1;
        }

        return  $sql->fetchAll();
    }

    public function SearchCategory(){
        //Step 1: Creting the variable that will recieve the object to the connection with the DB 
        $connection = parent::returnConnection();

        //Step 2: variable that will receive the SQL command to insert the information in the database
        $sql_command = 'select id_category, 
                            category_name
                        from tb_category
                        where fk_id_user = ?  order by category_name ASC';
        
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

    public function DeleteCategory($idCategoria){
        if($idCategoria == ''){            
            return 0;
        }

        //Step 1: Creting the variable that will recieve the object to the connection with the DB 
        $connection = parent::returnConnection();

        //Step 2: variable that will receive the SQL command to insert the information in the database
        $sql_command = 'delete 
                        from tb_category  
                        where id_category = ?
                           and fk_id_user = ?';

        //Step 3: Creating a object to send the information to the database
        $sql = new PDOStatement();

        //Step 4: To put inside the object $sql the connection prepared to execute the SQL command 
        $sql = $connection->prepare($sql_command); 

        //Step 5: Verify if the SQL command that I have to be settled up. If there re BindValues
        $sql->bindValue(1, $idCategoria);
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
  
    public function CategoriesDetails($idCategoria){

        //Step 1: Creting the variable that will recieve the object to the connection with the DB 
        $connection = parent::returnConnection();

        //Step 2: variable that will receive the SQL command to insert the information in the database
        $sql_command = 'select id_category, 
                            category_name
                        from tb_category
                        where id_category = ?
                           and fk_id_user = ?';

        //Step 3: Creating a object to send the information to the database
        $sql = new PDOStatement();

        //Step 4: To put inside the object $sql the connection prepared to execute the SQL command 
        $sql = $connection->prepare($sql_command); 

        //Step 5: Verify if the SQL command that I have to be settled up. If there re BindValues
        $sql->bindValue(1, $idCategoria);
        $sql->bindValue(2, UtilDAO::UserLoggedIn());

        //Step 7: Remove the Index from the Array. 
        //return each row as an array indexed by column name 
        //as returned in the corresponding result set.
        $sql->setFetchMode(PDO::FETCH_ASSOC);

        //Step 6:  Execute in the database 
        $sql->execute();

        return  $sql->fetchAll();
    }
}