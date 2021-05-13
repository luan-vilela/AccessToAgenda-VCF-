<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
    </head>
    <body>
        <?php
         header("Content-Type: text/html; charset=ISO-8859-1",true);
            include './System/Config.inc.php';
            $tm_inicio = microtime(true);
            $conection = new Connect;

            $sql = ''
                    . 'SELECT C.Nome, T.telefone '
                    . 'FROM Clientes_telefones AS T '
                    . 'INNER JOIN Ordem_de_servico AS C '
                    . 'ON C.Cliente = T.Cliente '
               //     . 'WHERE C.Cliente < 20 '
                    . 'GROUP BY C.Nome, T.telefone '
                    . '';
            $resultado = $conection->getCon()->query($sql);
            $tabela = $resultado->fetchAll(PDO::FETCH_ASSOC);
            $num = 0;
            foreach ($tabela as $tupla ){
                $nome = _nome($tupla['Nome']);
                $tel = _tel($tupla['telefone']);
                $txt = "BEGIN:VCARD"."\r\n"
                    ."VERSION:2.1"."\r\n"
                    ."N:;{$nome};;;"."\r\n"
                    ."FN:{$nome}"."\r\n"
                    ."TEL;CELL;PREF:{$tel}"."\r\n"
                    ."END:VCARD"."\r\n";
                gravar($txt);
                echo "Contato {$num} gerado.<br>";
                $num++;
            }
            $tm_fim = microtime(true);
            $tempo = $tm_fim - $tm_inicio;
            echo '<b>O sistema demorou '. $tempo .'s para converter banco em agenda!</b>';
        

            function gravar($txt){
                $arquivo = "Contados.vcf";
                
                $fp = fopen($arquivo, "a+");
                
                fwrite($fp, $txt);
                fclose($fp);
            }


            function _nome($nome){
                if(empty($nome)){
                    $nome = 'Sem Nome!';
                }
                
//                if(strlen($nome) > 14){
//                    return substr($nome, 0, 13).'..';
//                }
                
                return $nome;
            }
            
            function _tel($tel){
                $tel = (strstr($tel, ' ', true)) ? strstr($tel, ' ', true) : $tel;
                $tel = preg_replace('/-/', '', $tel);
                
                if(substr($tel,0,1) == 9 || substr($tel,0,1) == 8):
                    if(strlen($tel) == 8):
                        $tel = '+55679'.$tel;
                    endif;
                endif;
                
                return $tel;
            }
            
           

        ?>
    </body>
</html>
