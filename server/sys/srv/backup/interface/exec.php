<?php
# Inclui a dependência do arquivo de carregamento automático Autoloader
require_once "../../../../../Autoloader.php";
# Obtém uma instância de Autoloader
Autoloader::getInstance('root\\');
use root\server\sys\lib\exception\ManageException;
  $error = new ManageException(); // Instanciar o objeto.
  $error->register();
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
//TODO: Resolver path
#Muda o contexto para a pasta onde sera salvo o backup, a partir do root
chdir($root . "/r2/siged/server/var/bkp");

try {
  if (TUtil::backup_postgreSQL('siged')) {
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
