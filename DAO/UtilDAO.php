<?php

class UtilDAO{

        private static function StartSession(){
            if(!isset($_SESSION)){
                session_start();
            }
        }

        public static function CreateSession($cod, $name){
            
            self::StartSession();

            $_SESSION['cod'] = $cod;
            $_SESSION['name'] = $name;

        }

        public static function UserLoggedIn(){
            self::StartSession();
            return $_SESSION['cod'];      
        }

        public static function NameUserLoggedIn(){
            self::StartSession();
            return $_SESSION['name'];
        }

        public static function disconnect(){
            self::StartSession();
            unset($_SESSION['cod']);
            unset($_SESSION['name']);

            header('location: login.php');
            exit;
        }

        public static function VerifySession(){
            self::StartSession();
            if(!isset($_SESSION['cod']) || $_SESSION['cod'] == ''){
                header('location: login.php');
                exit;
            }
        }

        
}