<?php
  # Inclui a dependência do arquivo de carregamento automático Autoloader
  require_once "../../../../../Autoloader.php";
  # Obtém uma instância de Autoloader
  Autoloader::getInstance('root\\');
  use root\server\sys\lib\exception\ManageException;
  # Obtém uma instância de ManageException
  $error = new ManageException();
  # Registra o controle de exceções
  $error->register();
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
                $backups = BackupCtrl::todos();
                $root = $_SERVER['DOCUMENT_ROOT'];
                $path=  '/r2/siged/server/var/bkp/';
                foreach ($backups as $key) {
                  $filename = $root . $path . $key->no_backup;
                  $key->link =  $path . $key->no_backup;
                  if(!file_exists($filename)) {
                    #N caso o arquivo não seja encontrado
                    $key->st_registro = 'N';
                  }
                }
                $resultado['execucao'] = 'sucesso';
                $resultado['dados'] = $backups;
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
