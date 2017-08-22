<?php

namespace root\server\sys\lib\util;

/**
 * Trecho de código que concentra os métodos de manipulação de arquivos
 *
 * @package sys/lib
 * @subpackage util
 * @version 0.1
 * @author Rener Dias
 * @copyright (c) 2017, R2 Informática
 */
trait File {

    //TODO: Criar classe para files, rever função download, criar função uopz_overload
    /** ########## REALIZA O DOWNLOAD DE UM ARQUIVO
     * @function download => Função que realiza o download de um arquivo
     * @param arquivo => Recebe o nome do arquivo no disco
     * @param nome => Recebe o nome a ser dado ao arquivo no momento do download
     * @param mime => Recebe o mime type do arquivo
     * @param caminho => Recebe o caminho/path/local onde se encontra o arquivo
     */
    public function download($arquivo,$nome,$mime,$caminho){
        $path = $caminho.'/'.$arquivo;
        if (file_exists($path)) {
            // set headers
            header("Pragma: public");
            header("Expires: 0");
            header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
            header("Cache-Control: public");
            # Modo de transferencia de arquivo:
            header("Content-Description: File Transfer");
            # Tipo do arquivo:
            header("Content-Type: $mime");
            # O arquivo a ser baixado:
            header("Content-Disposition: attachment; filename=\"$nome\"");
            # Tamanho do arquivo:
            header("Content-Length: " . filesize($path));
            # Tipo de transferencia:
            header("Content-Transfer-Encoding: binary");
            # Limpa buffers de saida:
            ob_clean();
            ob_end_flush ();
            flush();
            # Usado para arquivo pequenos
            readfile($path);

            /*
             Técnica para arquivos grandes
             ----------------------------------------
            # Ler o arquivo como pedaço
            $file = fopen($path,"rb");
            #
            if ($file) {
                # L
                while(!feof($file)) {
                    print (fread($file, 1024));
                    flush();
                    if (connection_status()!=0) {
                        # Fecha o arquivo na memória
                        fclose($file);
                        # encerra o script/aplicação
                        die();
                    }
                }
                # Fecha o arquivo na memória
                fclose($file);
            }
             FIM - Técnica para arquivos grandes
             ----------------------------------------*/
            return true;
        } else {throw new Exception('Arquivo não encontrado no disco!'.$path);}
    }
}

?>
