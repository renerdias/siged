<?php
# Inclui a dependência do arquivo de carregamento automático Autoloader
require_once "../../../../../Autoloader.php";
# Obtém uma instância de Autoloader
Autoloader::getInstance('root\\');
?>
<?php
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: POST, GET, OPTIONS');
header('Access-Control-Allow-Headers: X-HTTP-Method-Override, Content-Type, x-requested-with, Authorization');

use root\server\sys\lib\util\TUtil;

#Pega o caminho atual
$caminho = getcwd();
#Pega o caminho da pasta root do servidor web (www)
$root = $_SERVER["DOCUMENT_ROOT"];
#Muda o contexto para a pasta onde sera salvo o backup, a partir do root
chdir($root . "/r2/siged/server/var/bkp");


/*]]
$config['host'] = "localhost";
$config['port = "5432";
$config['dbname = "siged";
$config['dbuser = "postgres";
$config['dbpass = "postgres";
$config['filename = Carbon::now()->format('Ymd-Hms');
$config['pg_dump_dir

$comand = "export PGPASSWORD=$DBPass && export PGUSER=$DBUser";
$comand .= " && /opt/PostgreSQL/9.6/bin/pg_dump --host $DBHost --port $DBPort -d $DB --format custom --blobs --encoding UTF8 --no-privileges --no-tablespaces --no-unlogged-table-data --file '$DB-$filename.r2bk' > error.log";
$comand .=" && unset PGPASSWORD=$DBPass && unset PGUSER=$DBUser";
//Função do Php
exec($comand, $saida, $retorno);
if ($retorno == 0) {
    return true;
} else {
    return;
}

*/
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
try {
  if (TUtil::backup_postgreSQL()) {
      $resultado['execucao'] = 'sucesso';
      $resultado['mensagem'] = 'Backup realizado com sucesso!';
  } else {
      $resultado['execucao'] = 'erro';
      $resultado['mensagem'] = 'Falha ao realizar o backup!';
  }
} catch (Exception $ex) {
    $resultado['execucao'] = 'erro';
    $resultado['mensagem'] = 'Erro desconhecido! Entre em contato com o administrador do sistema.';
    $resultado['log'] = $ex->getTraceAsString();
}
#Retorna contexto ao caminho original
chdir($caminho);
echo json_encode($resultado);
