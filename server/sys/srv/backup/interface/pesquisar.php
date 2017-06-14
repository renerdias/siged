<?php
# Inclui a dependência do arquivo de carregamento automático Autoloader
require_once "../../../../../Autoloader.php";
# Obtém uma instância de Autoloader
Autoloader::getInstance('root\\');
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
            case "nome":
                $nome = $_GET['nome'];
                $backups = BackupCtrl::pesquisarPorNome($nome);
                $resultado['execucao'] = 'sucesso';
                $resultado['dados'] = $backups;
                break;
            case "id":
                $id = $_GET['id'];
                $backup = BackupCtrl::pesquisarPorId($id);
                $resultado['execucao'] = 'sucesso';
                $resultado['dados'] = $backup;
                break;
            case "todos":
                $backups = BackupCtrl::todos();
                $resultado['execucao'] = 'sucesso';
                $resultado['dados'] = $backups;
                break;
            case "municipio":
                $id = $_GET['id'];
                $backups = BackupCtrl::pesquisarPorMunicipio($id);
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
