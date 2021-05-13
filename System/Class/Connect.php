<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Con
 *
 * @author luan
 */
class Connect {
    private static $user = USER;
    private static $pass = PASS;
    private static $host = LOCALHOST;
    private static $bd = BANCO;
    
    /** @var PDO */
    private static $Conection = null;
    
    
    private function Conected() {
        if(!file_exists(self::$host)){
            echo '<b>'.self::$host.'</b><br>';
            die("Não foi possível encontrar o banco de dados");
        }
       
        
        try {
            $drive = '{Microsoft Access Driver (*.mdb)}';
            $dsn = "odbc:DRIVER=$drive; DBQ=".self::$host;

            self::$Conection = new PDO($dsn);
        
                    
        } catch (Exception $ex) {
            self::$Conection = null;
            echo "Erro ao conectar ao banco de dados: " .'<b>'.self::$host.'</b> ' .$ex->getMessage() . " : ". $ex->getLine();
        }
        
        self::$Conection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        return self::$Conection;
        
    }
    
    public function getCon() {
        return self::Conected();
        
    }
    
    
    
    
}
