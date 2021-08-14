<?php


define('HOST', 'localhost'); //IP
define('USER', 'root'); //User
define('PASS', 'Pass1234'); //password
define('DB', 'db_financialcontrol'); //Database

/**
 * Conexao.class TIPO [Conexão]
 * Descricao: Estabelece conexões com o banco usando SingleTon
 
 */

class Connection {

    /** @var PDO */
    private static $Connect;

    private static function Connect() {
        try {

            //verify if there is a connection
            if (self::$Connect == null):

                $dsn = 'mysql:host=' . HOST . ';dbname=' . DB;
                self::$Connect = new PDO($dsn, USER, PASS, null);
            endif;
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
       
        //Seta os atributos para que seja retornado as excessões do banco
        self::$Connect->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
       
        return  self::$Connect;
    }

    public static function returnConnection() {
        return  self::Connect();
    }
    
    
}