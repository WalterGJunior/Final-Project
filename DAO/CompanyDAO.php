<?php

require_once 'Conexao.php';
require_once 'UtilDAO.php';

class CompanyDAO extends Conexao{

    public function CadastrarEmpresa($nome, $telefone, $endereco){
        if(trim($nome) == ''){            
            return 0;
        }

        //Step 1: Creting the variable that will recieve the object to the connection with the DB 
        $connection = parent::retornarConexao();

        //Step 2: variable that will receive the SQL command to insert the information in the database
        $sql_command = 'insert into tb_company
        (company_name, telephone_number, company_address, fk_id_user)
        values
        (?, ?, ?, ?);';
        
        //Step 3: Creating a object to send the information to the database
        $sql = new PDOStatement();

        //Step 4: To put inside the object $sql the connection prepared to execute the SQL command 
        $sql = $connection->prepare($sql_command); 

        //Step 5: Verify if the SQL command that I have to be settled up. If there re BindValues
        $sql->bindValue(1, $nome);
        $sql->bindValue(2, $telefone);
        $sql->bindValue(3, $endereco);
        $sql->bindValue(4, UtilDAO::CodigoLogado());

        try {

            //Step 6:  Execute in the database 
            $sql->execute();

            return 1;

        } catch (Exception $ex) {
            echo $ex->getMessage(); 
            return -1;
        }
    }

    public function SearchCompany(){
        //Step 1: Creting the variable that will recieve the object to the connection with the DB 
        $connection = parent::retornarConexao();

        //Step 2: variable that will receive the SQL command to search for the information in the database
        $sql_command = 'select id_company, 
                            company_name,
                            telephone_number,
                            company_address
                        from tb_company
                        where fk_id_user = ? order by company_name ASC';
        
        //Step 3: Creating a object to send the information to the database
        $sql = new PDOStatement();

        //Step 4: To put inside the object $sql the connection prepared to execute the SQL command 
        $sql = $connection->prepare($sql_command); 

        //Step 5: Verify if the SQL command that I have to be settled up. If there re BindValues
        $sql->bindValue(1, UtilDAO::CodigoLogado());

        //Step 7: Remove the Index from the Array. 
        //return each row as an array indexed by column name 
        //as returned in the corresponding result set.
        $sql->setFetchMode(PDO::FETCH_ASSOC);

        //Step 6:  Execute in the database 
        $sql->execute();

        return  $sql->fetchAll();
    }

    public function CompanyDetail($idEmpresa){

        //Step 1: Creting the variable that will recieve the object to the connection with the DB 
        $connection = parent::retornarConexao();

        //Step 2: variable that will receive the SQL command to insert the information in the database
        $sql_command = 'select id_company, 
                            company_name,
                            telephone_number,
                            company_address
                        from tb_company
                        where id_company = ?
                        and fk_id_user = ?';

        //Step 3: Creating a object to send the information to the database
        $sql = new PDOStatement();

        //Step 4: To put inside the object $sql the connection prepared to execute the SQL command 
        $sql = $connection->prepare($sql_command); 

        //Step 5: Verify if the SQL command that I have to be settled up. If there re BindValues
        $sql->bindValue(1, $idEmpresa);
        $sql->bindValue(2, UtilDAO::CodigoLogado());

        //Step 7: Remove the Index from the Array. 
        //return each row as an array indexed by column name 
        //as returned in the corresponding result set.
        $sql->setFetchMode(PDO::FETCH_ASSOC);

        //Step 6:  Execute in the database 
        $sql->execute();

        return  $sql->fetchAll();
    }

    public function AlterCompany($idEmpresa, $companyName, $telephoneCompany, $companyAddress ){
        if(trim($companyName) == '' || $idEmpresa == ''){            
            return 0;
        }

        //Step 1: Creting the variable that will recieve the object to the connection with the DB 
        $connection = parent::retornarConexao();

        //Step 2: variable that will receive the SQL command to insert the information in the database
        $sql_command = 'update tb_company  
                        set company_name = ?,
                            telephone_number =?,
                            company_address =?
                        where id_company = ?
                           and fk_id_user = ?';

        //Step 3: Creating a object to send the information to the database
        $sql = new PDOStatement();

        //Step 4: To put inside the object $sql the connection prepared to execute the SQL command 
        $sql = $connection->prepare($sql_command); 

        //Step 5: Verify if the SQL command that I have to be settled up. If there re BindValues
        $sql->bindValue(1, $companyName);
        $sql->bindValue(2, $telephoneCompany);
        $sql->bindValue(3, $companyAddress);
        $sql->bindValue(4, $idEmpresa);
        $sql->bindValue(5, UtilDAO::CodigoLogado());

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

    public function DeleteCompany($idEmpresa){
        if($idEmpresa == ''){            
            return 0;
        }

        //Step 1: Creting the variable that will recieve the object to the connection with the DB 
        $connection = parent::retornarConexao();

        //Step 2: variable that will receive the SQL command to insert the information in the database
        $sql_command = 'delete 
                        from tb_company  
                        where id_company = ?
                           and fk_id_user = ?';

        //Step 3: Creating a object to send the information to the database
        $sql = new PDOStatement();

        //Step 4: To put inside the object $sql the connection prepared to execute the SQL command 
        $sql = $connection->prepare($sql_command); 

        //Step 5: Verify if the SQL command that I have to be settled up. If there re BindValues
        $sql->bindValue(1, $idEmpresa);
        $sql->bindValue(2, UtilDAO::CodigoLogado());

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