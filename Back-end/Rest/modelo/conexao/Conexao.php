<?php
    class Conexao
    {
        private static $instancia;
        private $pdo;

        private function __construct()
        {
            $servidor = "";
            $banco = "";
            $usuario = "";
            $senha = "";
            $this -> pdo = new PDO("mysql:host=$servidor;dbname=$banco", $usuario, $senha, array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8"));
            $this -> pdo -> setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        }

        public static function recuperar()
        {
            if (!isset(self::$instancia))
                self::$instancia = new Conexao();
            return self::$instancia -> pdo;
        }
    }
?>
