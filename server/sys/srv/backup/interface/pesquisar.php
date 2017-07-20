<?php
# Inclui a dependência do arquivo de carregamento automático Autoloader
require_once "../../../../../Autoloader.php";
# Obtém uma instância de Autoloader
Autoloader::getInstance('root\\');
use root\server\sys\lib\exception\ManageException;
  $error = new ManageException(); // Instanciar o objeto.
  $error->register();


/*
echo 'DIRECTORY ITERATOR'.PHP_EOL;
	$path = '.';
	$dir = new DirectoryIterator($path);
  $bkps = []
	foreach ($dir as $fileInfo) {
    //var_dump($fileInfo);
    echo "<br>";
    //echo $fileInfo->getFilename();
    echo "<br>";
    $bkps[]['link'] = "<a href='./server/var/bkp/" . $fileInfo->getFilename() . "'>" . $fileInfo->getFilename() . "</a>";
    echo "<br>";
    echo "<br>";
    echo "<br>";
    #Retorna o tamanho do arquivo
    //$fileInfo->getSize();

#    DirectoryIterator::getATime — Retorna a data de último acesso do arquivo
#    DirectoryIterator::getBasename — Retorna o nome do item corrente do DirectoryIterator.
#    DirectoryIterator::getCTime — Retorna a data de modificação do inode do arquivo
#    DirectoryIterator::getExtension — Retorna a extensão do arquivo do item corrente do DirectoryIterator
#    DirectoryIterator::getFilename — Retorna o nome do arquivo do elemento atual do diretório
#    DirectoryIterator::getGroup — Retorna o grupo do arquivo
#    DirectoryIterator::getInode — Retorna o inode do arquivo
#    DirectoryIterator::getMTime — Retorna a data da última modificação do arquivo
#    DirectoryIterator::getOwner — Retorna o proprietário do arquivo
#    DirectoryIterator::getPath — Retorna o caminho do diretório
#    DirectoryIterator::getPathname — Retorna o caminho e o nome do arquivo do elemento atual do diretório
#    DirectoryIterator::getPerms — Retorna as permissões do arquivo
#    DirectoryIterator::getSize — Retorna o tamanho do arquivo
#    DirectoryIterator::getType — Retorna o tipo do arquivo
#    DirectoryIterator::isDir — Retorna true se o elemento atual é um diretório
#    DirectoryIterator::isDot — Retorna true se o elemento atual for '.' ou '..'
#    DirectoryIterator::isExecutable — Retorna true se o arquivo for executável
#    DirectoryIterator::isFile — Retorna true se o elemento atual for um arquivo
#    DirectoryIterator::isLink — Retorna true se o elemento atual for um link simbólico
#    DirectoryIterator::isReadable — Retorna true se o arquivo pode ser lido
#    DirectoryIterator::isWritable — Retorna true se o arquivo pode ser modificado
#    DirectoryIterator::key — Retorna o elemento atual do diretório
#    DirectoryIterator::next — Avança para o próximo elemento
#    DirectoryIterator::rewind — Recomeça a iteração do diretório
#    DirectoryIterator::seek — Procura uma determinada posição no item do DirectoryIterator
#    DirectoryIterator::__toString — Retorna o nome do arquivo como texto
#    DirectoryIterator::valid — Verifica se o diretório possui ou não mais elementos
    PHP_EOL;
    	$ext = strtolower( $fileInfo->getExtension() );
	    //if( in_array( $ext, $types ) ) echo $fileInfo->getFilename().PHP_EOL;
	}
  */
?>
<?php
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: POST, GET');
header('Access-Control-Allow-Headers: X-HTTP-Method-Override, Content-Type, x-requested-with, Authorization');

use root\server\sys\srv\backup\controller\BackupCtrl;
try {
    $pesquisarPor = $_GET['por'];
    try {
        switch ($pesquisarPor) {
            case "todos":
                //$backups = BackupCtrl::todos();

                $path = $_SERVER['DOCUMENT_ROOT'] . '/r2/server/var/bkp';
                $dir = new DirectoryIterator($path);
                $bkps = [];
                foreach ($dir as $fileInfo) {
                  //$bkps[]['no_arquivo'] = "<a href='./server/var/bkp/" . $fileInfo->getFilename() . "'><i class='fa fa-download'></i></a>";
                  if ($fileInfo->isFile()){
                  $bkps[]['no_arquivo'] = $fileInfo->getFilename();
                  $bkps[]['tm_arquivo'] = $fileInfo->getSize();
                  $bkps[]['dt_arquivo'] = $fileInfo->getMTime();
                  $bkps[]['link'] = "<a href='./server/var/bkp/" . $fileInfo->getFilename() . "'><i class='fa fa-download'></i></a>";
                  #Retorna o tamanho do arquivo
                  //$fileInfo->getSize();
                }
                }
                $resultado['execucao'] = 'sucesso';
                $resultado['dados'] = $bkps;
                break;
            default:
                break;
        }
    } catch (PDOException $ex) {
        $resultado['execucao'] = 'erro';
        $resultado['mensagem'] = 'ERROR: Erro desconhecido! Entre em contato com o administrador do sistema.';
        $resultado['log'] = $ex->getMessage() . ' - Código: ' . $ex->getCode();
    } catch (Exception $ex) {
        $resultado['execucao'] = 'erro';
        $resultado['mensagem'] = 'ERROR: Erro desconhecido! Entre em contato com o administrador do sistema.';
        $resultado['log'] = $ex->getTraceAsString();
    }
} finally {
    echo json_encode($resultado);
}
