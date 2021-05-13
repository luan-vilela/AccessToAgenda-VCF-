<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Config
 *
 * @author luan
 */
/**
 * ****************************************
 * **********  CONSTANTES BANCO  **********
 * ****************************************
 */
define('LOCALHOST',$_SERVER["DOCUMENT_ROOT"] . "/eletronicaalfa/System/BD/BD_VENDAS.mdb");
define('USER','');
define('PASS','');
define('BANCO','BD_VENDAS');



/**
 * ****************************************
 * **********   MÉTODO AUTOLOAD  ********** 
 * ****************************************
 */

function Autoload($NomeArquivo) {
    $extencao = '.php';
    $dir = ['Class'];
   
    foreach ($dir as $folder):
        if (file_exists(__DIR__."/{$folder}/{$NomeArquivo}{$extencao}")):
            require_once (__DIR__."/{$folder}/{$NomeArquivo}{$extencao}");
        endif;
    endforeach;
}
spl_autoload_register("Autoload");
