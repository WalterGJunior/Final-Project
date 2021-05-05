<?php

require_once 'Conexao.php';
require_once 'UtilDAO.php';

class UsuarioDAO extends Conexao{

    public function CarregarMeusDados(){

        //Step 1: Creting the variable that will recieve the object to the connection with the DB 
        $connection = parent::retornarConexao();

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
        $sql->bindValue(1, UtilDAO::CodigoLogado());

        //Step 7: Remove the Index from the Array. 
        //return each row as an array indexed by column name 
        //as returned in the corresponding result set.
        $sql->setFetchMode(PDO::FETCH_ASSOC);

        //Step 6:  Execute in the database 
        $sql->execute();

        return  $sql->fetchAll();

        
    }

    public function GravarMeusDados($name, $email){

        if(trim($name) == '' || trim($email) == ''){
            return 0;
        }

        //Step 1: Creting the variable that will recieve the object to the connection with the DB 
        $connection = parent::retornarConexao();

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
        $sql->bindValue(3, UtilDAO::CodigoLogado());

        try {
 
            //Step 6:  Execute in the database 
            $sql->execute();

            return 1;

        } catch (Exception $ex) {
            echo $ex->getMessage(); 
            return -1;
        }

    }

    public function ValidarLogin($email, $senha){
        if(trim($email) == '' || trim($senha) == ''){
            return 0;
        }
    }

    public function CriarCadastro($nome, $email, $senha, $rsenha){
        if(trim($nome) == '' || trim($email) == '' || trim($senha) == '' || trim($rsenha) == ''){
            return 0;
        }

        if(strlen($senha) < 6){
            return -2;
        } 
        
        if(strlen($senha) != trim($rsenha)){
            return -3;
        }
    }

}