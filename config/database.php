<?php

    class Database {
        private $hostname = "localhost";
        private $database = "e_shop";
        private $username = "root";
        private $password = "1234";
        private $charset = "utf8";

        function conectar(){
            try{
            $conexion = "mysql:host=" . $this->hostname . "; dbname=" . $this->database . "; charset=" . $this->charset; 
            $options = [
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                PDO::ATTR_EMULATE_PREPARES => false
            ];
            
            $pdo = new PDO($conexion, $this->username, $this->password, $options);

            return $pdo;

        }catch(PDOException $e) {
            echo 'Error conexion: ' . $e->getMessage();
            exit;
        }
    }
}
/*
function conectar() {
    $host = "localhost:8889";
    $user = "root";
    $pass = "root";
    $bd = "e_shop";
    $conn = mysqli_connect($host, $user, $pass);
    mysqli_select_db($conn, $bd);
    return $conn;
}
*/
?>